<?php

namespace App\Http\Controllers;

use App\Link;
use App\Redirect;
use Illuminate\Http\Request;

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
}
