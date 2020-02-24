<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeLinksCount = number_format(auth()->user()->getActiveLinks()->count());
        $inactiveLinksCount = number_format(auth()->user()->getInactiveLinks()->count());
        $redirectsThisMonthCount = number_format(auth()->user()->getRedirectsThisMonth());
        $clicksThisMonthCount = number_format(auth()->user()->getClicksThisMonth());

        $redirectsGraphData = [];
        $adClicksGraphData = [];

        return view('dashboard', [
            'activeLinksCount' => $activeLinksCount,
            'inactiveLinksCount' => $inactiveLinksCount,
            'redirectsThisMonthCount' => $redirectsThisMonthCount,
            'clicksThisMonthCount' => $clicksThisMonthCount,
            'redirectsGraphData' => $redirectsGraphData,
            'adClicksGraphData' => $adClicksGraphData,
        ]);
    }
}
