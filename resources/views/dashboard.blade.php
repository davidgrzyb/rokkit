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
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ $activeLinksCount }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Active Links</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-rounded shadow-sm" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ $inactiveLinksCount }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Inactive Links</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-rounded shadow-sm" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ $redirectsThisMonthCount }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Redirects this Month</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-rounded shadow-sm" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-primary-dark">{{ $clicksThisMonthCount }}</div>
                            <div class="font-size-sm font-w600 text-primary-light">Advertisement Clicks</div>
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
    <script>
        ! function(e) {
            var t = {};

            function r(o) {
                if (t[o]) return t[o].exports;
                var n = t[o] = {
                    i: o,
                    l: !1,
                    exports: {}
                };
                return e[o].call(n.exports, n, n.exports, r), n.l = !0, n.exports
            }
            r.m = e, r.c = t, r.d = function(e, t, o) {
                r.o(e, t) || Object.defineProperty(e, t, {
                    enumerable: !0,
                    get: o
                })
            }, r.r = function(e) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                    value: "Module"
                }), Object.defineProperty(e, "__esModule", {
                    value: !0
                })
            }, r.t = function(e, t) {
                if (1 & t && (e = r(e)), 8 & t) return e;
                if (4 & t && "object" == typeof e && e && e.__esModule) return e;
                var o = Object.create(null);
                if (r.r(o), Object.defineProperty(o, "default", {
                        enumerable: !0,
                        value: e
                    }), 2 & t && "string" != typeof e)
                    for (var n in e) r.d(o, n, function(t) {
                        return e[t]
                    }.bind(null, n));
                return o
            }, r.n = function(e) {
                var t = e && e.__esModule ? function() {
                    return e.default
                } : function() {
                    return e
                };
                return r.d(t, "a", t), t
            }, r.o = function(e, t) {
                return Object.prototype.hasOwnProperty.call(e, t)
            }, r.p = "", r(r.s = 50)
        }({
            50: function(e, t, r) {
                e.exports = r(51)
            },
            51: function(e, t) {
                function r(e, t) {
                    for (var r = 0; r < t.length; r++) {
                        var o = t[r];
                        o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                    }
                }
                var o = function() {
                    function e() {
                        ! function(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }(this, e)
                    }
                    var t, o, n;
                    return t = e, n = [{
                        key: "initMinimalChartJS",
                        value: function() {
                            Chart.defaults.global.defaultFontColor = "#7c7c7c", Chart.defaults.scale.gridLines.color = "transparent", Chart.defaults.scale.gridLines.zeroLineColor = "transparent", Chart.defaults.scale.display = !1, Chart.defaults.scale.ticks.beginAtZero = !0, Chart.defaults.global.elements.line.borderWidth = 2, Chart.defaults.global.elements.point.radius = 3, Chart.defaults.global.elements.point.hoverRadius = 5, Chart.defaults.global.tooltips.cornerRadius = 3, Chart.defaults.global.legend.display = !1;
                            var e = jQuery(".js-chartjs-minimal-lines"),
                                t = jQuery(".js-chartjs-minimal-lines2");
                            e.length && new Chart(e, {
                                type: "line",
                                data: {
                                    labels: {!! json_encode($redirectsGraphData['labels']) !!},
                                    datasets: [{
                                        label: "This Week",
                                        fill: !0,
                                        backgroundColor: "rgba(131,191,240,.2)",
                                        borderColor: "rgba(131,191,240,.6)",
                                        pointBackgroundColor: "rgba(131,191,240,.6)",
                                        pointBorderColor: "#fff",
                                        pointHoverBackgroundColor: "#fff",
                                        pointHoverBorderColor: "rgba(92,85,75,.4)",
                                        data: {!! json_encode($redirectsGraphData['data']) !!}
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                suggestedMax: {!! max($redirectsGraphData['data']) === 0 ? 1 : max($redirectsGraphData['data']) !!}
                                            }
                                        }]
                                    },
                                    tooltips: {
                                        callbacks: {
                                            label: function(e, t) {
                                                return " " + e.yLabel + " Redirects"
                                            }
                                        }
                                    }
                                }
                            }), t.length && new Chart(t, {
                                type: "line",
                                data: {
                                    labels: {!! json_encode($adClicksGraphData['labels']) !!},
                                    datasets: [{
                                        label: "This Week",
                                        fill: !0,
                                        backgroundColor: "rgba(131,191,240,.2)",
                                        borderColor: "rgba(131,191,240,.6)",
                                        pointBackgroundColor: "rgba(131,191,240,.6)",
                                        pointBorderColor: "#fff",
                                        pointHoverBackgroundColor: "#fff",
                                        pointHoverBorderColor: "rgba(146,170,90,.4)",
                                        data: {!! json_encode($adClicksGraphData['data']) !!}
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                suggestedMax: {!! max($redirectsGraphData['data']) === 0 ? 1 : max($redirectsGraphData['data']) !!}
                                            }
                                        }]
                                    },
                                    tooltips: {
                                        callbacks: {
                                            label: function(e, t) {
                                                return " " + e.yLabel + " Clicks"
                                            }
                                        }
                                    }
                                }
                            })
                        }
                    }, {
                        key: "init",
                        value: function() {
                            this.initMinimalChartJS()
                        }
                    }], (o = null) && r(t.prototype, o), n && r(t, n), e
                }();
                jQuery((function() {
                    o.init()
                }))
            }
        });
    </script>
@endsection
