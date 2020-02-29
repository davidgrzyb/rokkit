<?php

namespace App\Http\Controllers;

use App\Link;
use App\Click;
use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use Illuminate\Foundation\Http\FormRequest;

class LinkController extends Controller
{
    public function index()
    {
        return view('links.index');
    }

    public function redirect($domain, string $slug)
    {
        $link = Link::whereHas('domain', function ($query) use ($domain) {
            return $query->where('name', $domain);
        })->where('slug', $slug)->firstOrFail();

        if (! $link->isEnabled()) {
            return redirect('/');
        }

        // Create record of redirection.
        if (! Auth::check() || $link->user_id !== Auth::id()) {
            Redirect::create(['link_id' => $link->id]);
        }

        // Redirect to advertising page.
        if ($link->ad_target) {
            return view('links.redirect')->withLink($link);
        }

        // If link is just a normal redirect, redirect to target.
        return redirect()->to('//'.$link->target);
    }

    public function create()
    {
        $domains = auth()->user()->domains;
        return view('links.create')->withDomains($domains);
    }

    public function view(int $id)
    {
        $link = Link::where('user_id', auth()->user()->id)->findOrFail($id);
        $domains = auth()->user()->domains;
        return view('links.view')
            ->withLink($link)
            ->withDomains($domains);
    }

    public function store(CreateLinkRequest $request)
    {
        if ($request->input('slug') &&
            ! $this->checkSlug($request->input('slug'), $request->input('domain-id'))) {
            return redirect()
                ->route('links.create')
                ->withErrors(['message' => 'The chosen slug is already taken.']);
        }

        $link = Link::create([
            'enabled'   => true,
            'user_id'   => auth()->user()->id,
            'domain_id' => $request->input('domain-id'),
            'slug'      => $request->input('slug') ?? Link::generateSlug(),
            'target'    => $this->sanitizeUrl($request->input('target-url')),
            'ad_target' => '',
            'delay'     => 0,
        ]);

        if ($request->input('advertising-enabled') === 'true') {
            $image = $this->saveImage($link, $request->file('image'));
            $link->image = $image ? $image : $link->image;
            $link = $this->fillAdvertisingData($link, $request);
        }

        $link->save();

        return redirect()->route('links.index', [$link->id])->withMessage('Your link has been created successfully!');
    }

    public function update(UpdateLinkRequest $request)
    {
        $link = Link::query()
            ->where('user_id', auth()->user()->id)
            ->findOrFail($request->input('link-id'));

        if ($request->input('slug') && 
            ! $this->checkSlug($request->input('slug'), $request->input('domain-id'), $link)) {
            return redirect()
                ->route('links.view', [$link->id])
                ->withErrors(['message' => 'The chosen slug is already taken.']);
        }
        
        $link->fill([
            'enabled'   => $request->input('enabled') === 'on',
            'domain_id' => $request->input('domain-id'),
            'slug'      => $request->input('slug') ?? Link::generateSlug(),
            'target'    => $this->sanitizeUrl($request->input('target-url')),
        ]);

        if ($request->input('advertising-enabled') === 'true') {
            $image = $this->saveImage($link, $request->file('image'));
            $link->image = $image ? $image : $link->image;
            $link = $this->fillAdvertisingData($link, $request);
        } else {
            $link->resetAdvertisementColumns();
        }

        $link->save();

        return redirect()->route('links.view', [$link->id])->withMessage('Link updated successfully!');
    }

    public function redirectToAdvertisement(string $domain, int $id)
    {
        $link = Link::whereHas('domain', function ($query) use ($domain) {
            return $query->where('name', $domain);
        })->findOrFail($id);

        // Create record of advertising click.
        if (! Auth::check() || $link->user_id !== Auth::id()) {
            Click::create(['link_id' => $link->id]);
        }

        // If link is just a normal redirect, redirect to target.
        return redirect()->to('//'.$link->ad_target);
    }

    protected function fillAdvertisingData(Link $link, FormRequest $request)
    {
        $link->fill([
            'main_text'            => $request->input('main-text'),
            'secondary_text'       => $request->input('secondary-text'),
            'ad_target'            => $this->sanitizeUrl($request->input('ad-target')),
            'delay'                => $request->input('delay'),
            'progress_bar_enabled' => $request->input('show-progress-bar'),
            'skip_button_enabled'  => $request->input('show-skip-button'),
            'bg_color'             => $request->input('page-bg-hex') ?? '#f0f2f5',
            'main_text_color'      => $request->input('main-text-hex') ?? '#000000',
            'secondary_text_color' => $request->input('secondary-text-hex') ?? '#000000',
        ]);

        return $link;
    }

    protected function saveImage(Link $link, $image)
    {
        if (! $image) {
            return null;
        }

        $location = sprintf(
            '%s/%s-%s.%s',
            config('rokkit.advertisement_storage_directory'),
            $link->slug,
            now()->timestamp,
            $image->getClientOriginalExtension()
        );

        Storage::disk('public')->put($location, File::get($image));

        return $location;
    }

    protected function checkSlug(string $slug, int $domainId, $link = null)
    {
        if ($link && $link->slug === $slug) {
            return true;
        }

        return ! Link::where('domain_id', $domainId)->where('slug', $slug)->exists();
    }

    protected function sanitizeUrl($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (substr($url, 0, 5) === 'https') {
            $url = substr($url, 8, strlen($url));
        } else if (substr($url, 0, 4) === 'http') {
            $url = substr($url, 7, strlen($url));
        }

        return $url;
    }
}
