<?php

namespace App\Http\Controllers;

use App\Link;
use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function update(Request $request)
    {
        $request->validate([
            'link-id' => ['required', 'exists:links,id'],
            'domain-id' => ['required', 'exists:domains,id'],
            'slug' => ['required', 'max:50'],
            'target-url' => ['required'],
            'image' => ['nullable', 'mimes:jpg,png,gif,jpeg', 'max:5000'],
            'main-text' => ['required_if:advertising-enabled,true', 'string', 'max:250'],
            'secondary-text' => ['required_if:advertising-enabled,true', 'string', 'max:500'],
            'ad-target' => ['required_if:advertising-enabled,true'],
            'delay' => ['required_if:advertising-enabled,true', 'integer', 'max:15'],
            'show-progress-bar' => ['required_if:advertising-enabled,true', 'boolean'],
            'show-skip-button' => ['required_if:advertising-enabled,true', 'boolean'],
            'page-bg-hex' => ['nullable', 'string', 'max:8'],
            'main-text-hex' => ['nullable', 'string', 'max:8'],
            'secondary-text-hex' => ['nullable', 'string', 'max:8'],
        ]);

        $link = Link::findOrFail($request->input('link-id'));

        if ($this->checkSlug($link, $request->input('slug'))) {
            $link->slug = $request->input('slug');
        } else {
            return redirect()->route('links.view', [$link->id])->withErrors(['message' => 'The chosen slug is already taken.']);
        }
        
        $link->enabled = $request->input('enabled') === 'on';
        $link->domain_id = $request->input('domain-id');
        $link->slug = $request->input('slug') ?? $this->generateSlug();
        $link->target = $this->sanitizeUrl($request->input('target-url'));

        if ($request->input('advertising-enabled') === 'true') {
            $link->image = $request->input('image');
            $link->main_text = $request->input('main-text');
            $link->secondary_text = $request->input('secondary-text');
            $link->ad_target = $this->sanitizeUrl($request->input('ad-target'));
            $link->delay = $request->input('delay');
            $link->progress_bar_enabled = $request->input('show-progress-bar');
            $link->skip_button_enabled = $request->input('show-skip-button');
            $link->bg_color = $request->input('page-bg-hex') ?? '#000000';
            $link->main_text_color = $request->input('main-text-hex') ?? '#000000';
            $link->secondary_text_color = $request->input('secondary-text-hex') ?? '#000000';
        } else {
            $link->image = null;
            $link->main_text = null;
            $link->secondary_text = null;
            $link->ad_target = '';
            $link->delay = 0;
            $link->progress_bar_enabled = true;
            $link->skip_button_enabled = false;
            $link->bg_color = null;
            $link->main_text_color = null;
            $link->secondary_text_color = null;
        }

        $link->save();

        return redirect()->route('links.view', [$link->id])->withMessage('Link updated successfully!');
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
            $link = substr($url, 8, strlen($url));
        } else if (substr($url, 0, 4) === 'http') {
            $link = substr($url, 7, strlen($url));
        } else {
            $link = $url;
        }

        if (substr($link, -1) === '/') {
            $link = substr($link, 0, strlen($link)-1);
        }

        return $link;
    }

    protected function generateSlug()
    {
        do {
            $slug = substr(md5(rand()), 0, 7);
        } while (Link::where('slug', '=', $slug)->exists());

        return $slug;
    }
}
