<?php

namespace App\Http\Controllers;

use App\Link;
use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateLinkRequest;

class LinkController extends Controller
{
    public function index()
    {
        return view('links.index');
    }

    public function redirect(string $slug)
    {
        $link = Link::where('slug', $slug)->firstOrFail();

        if (! $link->isEnabled()) {
            return redirect('/');
        }

        // Create record of redirection.
        Redirect::create(['link_id' => $link->id]);

        // Redirect to advertising page.
        if ($link->ad_target) {
            return view('links.advertisement')->withLink($link);
        }

        // If link is just a normal redirect, redirect to target.
        return redirect()->to('//'.$link->target);
    }

    public function view(int $id)
    {
        $link = Link::findOrFail($id);
        $domains = auth()->user()->domains;
        return view('links.view')
            ->withLink($link)
            ->withDomains($domains);
    }

    public function create(CreateLinkRequest $request)
    {
        $link = Link::findOrFail($request->input('link-id'));

        if (! $this->checkSlug($link, $request->input('slug'))) {
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

        if ($request->input('advertising-enabled') !== 'true') {
            $link->resetAdvertisementColumns()->save();

            return redirect()
                ->route('links.view', [$link->id])
                ->withMessage('Link updated successfully!');
        }

        $image = $this->saveImage($link, $request->file('image'));

        $link->fill([
            'image'                => $image ? $image : $link->image,
            'main_text'            => $request->input('main-text'),
            'secondary_text'       => $request->input('secondary-text'),
            'ad_target'            => $this->sanitizeUrl($request->input('ad-target')),
            'delay'                => $request->input('delay'),
            'progress_bar_enabled' => $request->input('show-progress-bar'),
            'skip_button_enabled'  => $request->input('show-skip-button'),
            'bg_color'             => $request->input('page-bg-hex') ?? '#000000',
            'main_text_color'      => $request->input('main-text-hex') ?? '#000000',
            'secondary_text_color' => $request->input('secondary-text-hex') ?? '#000000',
        ])->save();

        return redirect()->route('links.view', [$link->id])->withMessage('Link updated successfully!');
    }

    public function update(UpdateLinkRequest $request)
    {
        $link = Link::findOrFail($request->input('link-id'));

        if (! $this->checkSlug($link, $request->input('slug'))) {
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

        if ($request->input('advertising-enabled') !== 'true') {
            $link->resetAdvertisementColumns()->save();

            return redirect()
                ->route('links.view', [$link->id])
                ->withMessage('Link updated successfully!');
        }

        $image = $this->saveImage($link, $request->file('image'));

        $link->fill([
            'image'                => $image ? $image : $link->image,
            'main_text'            => $request->input('main-text'),
            'secondary_text'       => $request->input('secondary-text'),
            'ad_target'            => $this->sanitizeUrl($request->input('ad-target')),
            'delay'                => $request->input('delay'),
            'progress_bar_enabled' => $request->input('show-progress-bar'),
            'skip_button_enabled'  => $request->input('show-skip-button'),
            'bg_color'             => $request->input('page-bg-hex') ?? '#000000',
            'main_text_color'      => $request->input('main-text-hex') ?? '#000000',
            'secondary_text_color' => $request->input('secondary-text-hex') ?? '#000000',
        ])->save();

        return redirect()->route('links.view', [$link->id])->withMessage('Link updated successfully!');
    }

    protected function saveImage($link, $image)
    {
        if (! $image) {
            return null;
        }

        $location = sprintf(
            '%s/%s-%s.%s',
            config('rokkit.advertisement-storage-directory'),
            $link->slug,
            now()->timestamp,
            $image->getClientOriginalExtension()
        );

        Storage::disk('public')->put($location, File::get($image));

        return $location;
    }

    protected function checkSlug(Link $link, string $slug)
    {
        if ($link->slug === $slug) {
            return true;
        }

        if (! Link::where('slug', $slug)->exists()) {
            return true;
        }

        return false;
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
