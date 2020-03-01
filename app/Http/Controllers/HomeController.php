<?php

namespace App\Http\Controllers;

use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redirectsCount = Cache::remember('home-redirects-count', now()->addMinutes(5), function () {
            return Redirect::count();
        });

        return view('home')->withRedirectsCount($redirectsCount);
    }
}
