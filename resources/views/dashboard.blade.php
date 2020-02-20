@extends('layouts.minimal')

@section('content')
    <div class="bg-white">
        <div class="content content-full">
            <div class="pt-30 pb-30 text-center">
                <h1 class="font-w300 mb-30">Dashboard</h1>
                <h2 class="h4 text-muted font-w300 mb-0">Hey there, let's make some links!</h2>
            </div>
        </div>
    </div>
    <div class="content">
        @include('alerts.redirect-limit')
        <div class="row">
            <div class="col-6 col-xl-3">
                <a class="block block-rounded shadow-sm" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ number_format(auth()->user()->getActiveLinks()->count()) }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Active Links</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-rounded shadow-sm" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ number_format(auth()->user()->getRedirectsThisMonth()) }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Redirects this Month</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-rounded shadow-sm" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ number_format(auth()->user()->getClicksThisMonth()) }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Advertisement Clicks</div>
                        </div>
                    </div>
                </a>
            </div>
            @php
                $daysThisMonth = now()->daysInMonth;
                $dayOfTheMonth = now()->format('d');
                $average = (auth()->user()->getRedirectsThisMonth() / $dayOfTheMonth) * $daysThisMonth;
            @endphp
            <div class="col-6 col-xl-3">
                <a class="block block-rounded shadow-sm" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ number_format($average) }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Estimated Monthly Redirects</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="block block-rounded shadow-sm">
                    <div class="block-header">
                        <h3 class="block-title font-w600">Redirects</h3>
                    </div>
                    <div class="block-content">
                        <div class="pull-all"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas class="js-chartjs-minimal-lines chartjs-render-monitor" style="display: block; width: 561px; height: 280px;" width="561" height="280"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded shadow-sm">
                    <div class="block-header">
                        <h3 class="block-title font-w600">Ad Clicks</h3>
                    </div>
                    <div class="block-content">
                        <div class="pull-all"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas class="js-chartjs-minimal-lines2 chartjs-render-monitor" width="561" height="280" style="display: block; width: 561px; height: 280px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_after')
@endsection

@section('js_after')
    <script src="{{ asset('/js/plugins/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/pages/dashboard_charts.min.js') }}"></script>
@endsection
