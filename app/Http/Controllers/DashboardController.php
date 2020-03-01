<?php

namespace App\Http\Controllers;

use App\Click;
use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $countData = Cache::remember('dashboard-count-values-standing-'.auth()->user()->id, now()->addMinutes(5), function () {
            return [
                'active_links' => number_format(auth()->user()->getActiveLinks()->count()),
                'inactive_links' => number_format(auth()->user()->getInactiveLinks()->count()),
                'redirects_count' => number_format(auth()->user()->getRedirectsThisMonth()),
                'clicks_count' => number_format(auth()->user()->getClicksThisMonth()),
            ];
        });

        $graphData = Cache::remember('dashboard-graph-data-'.auth()->user()->id, now()->addMinutes(5), function () {
            $redirects = Redirect::query()
                ->whereHas('link', function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })
                ->where('created_at', '>', now()->subDays(7))
                ->get();

            $clicks = Click::query()
                ->whereHas('link', function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })
                ->where('created_at', '>', now()->subDays(7))
                ->get();

            $redirectsGraphData = [
                'labels' => [],
                'data' => [],
            ];

            $adClicksGraphData = [
                'labels' => [],
                'data' => [],
            ];

            for ($i=6; $i >= 0; $i--) {
                $day = now()->subDays($i);

                $redirectsCount = $redirects->filter(function ($redirect) use ($day) {
                    return $redirect->created_at->isSameDay($day);
                })->count();
                $clicksCount = $clicks->filter(function ($click) use ($day) {
                    return $click->created_at->isSameDay($day);
                })->count();

                array_push($redirectsGraphData['labels'], $day->toDateString());
                array_push($redirectsGraphData['data'], $redirectsCount);

                array_push($adClicksGraphData['labels'], $day->toDateString());
                array_push($adClicksGraphData['data'], $clicksCount);
            }

            return [
                'redirects' => $redirectsGraphData,
                'clicks' => $adClicksGraphData,
            ];
        });

        return view('dashboard', [
            'activeLinksCount' => $countData['active_links'],
            'inactiveLinksCount' => $countData['inactive_links'],
            'redirectsThisMonthCount' => $countData['redirects_count'],
            'clicksThisMonthCount' => $countData['clicks_count'],
            'redirectsGraphData' => $graphData['redirects'],
            'adClicksGraphData' => $graphData['clicks'],
        ]);
    }
}
