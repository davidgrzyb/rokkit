<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">

        <title>Rokkit Redirect</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">

        <!-- Styles -->
        <style>
            body {
                background-color: {{ $link->bg_color ?? '#f0f2f5' }};
            }

            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
            }

            .vertical-center {
                min-height: 100%;
                min-height: 100vh;
                display: flex;
                align-items: center;
            }
        </style>
        
    </head>
    <body>
        <div class="content-header-item pl-20 pt-20">
            <a class="link-effect font-w700" href="{{ url('/dashboard') }}">
                <i class="si si-rocket text-primary"></i>
                <span class="font-size-xl text-dual-primary-dark">rokk</span><span class="font-size-xl text-primary">it</span>
            </a>
        </div>

        <div class="jumbotron vertical-center">
            <div class="container">

                @if($link->main_text)
                    <div class="row">
                        <div class="col-md-12 text-center pb-2">
                            <h1 class="font-w400">
                                <a target="_blank" href="{{ url('/ad', [$link->id]) }}" style="color:{{ $link->main_text_color }};">{{ $link->main_text ?? '#000' }}</a>
                            </h1>
                        </div>
                    </div>
                @endif

                @if($link->image)
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a target="_blank" href="{{ url('/ad', [$link->id]) }}">
                                <img class="img img-fluid" src="{{ asset($link->image) }}">
                            </a>
                        </div>
                    </div>
                @endif

                @if($link->secondary_text)
                    <div class="row">
                        <div class="col-md-12 text-center pt-4">
                            <p class="font-w400">
                                <a target="_blank" href="{{ url('/ad', [$link->id]) }}" style="color:{{ $link->secondary_text_color }};font-size:16px;">{{ $link->secondary_text ?? '#000' }}</a>
                            </p>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4 offset-md-4 text-center pt-20">
                        <p class="text-muted">
                            Redirecting in 
                            <span id="timer">{{ $link->delay }}</span> 
                            seconds... 
                        </p>
                        <div class="text-center">
                            @if($link->progress_bar_enabled)
                                <div class="progress center-block">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" id="progressbar" style="width: 100%;">
                                        <span id="progress-bar-label" class="progress-bar-label" style="display:none;">100%</span>
                                    </div>
                                </div>
                            @endif
                            @if($link->skip_button_enabled)
                                <a class="btn btn-md btn-outline-dark @if($link->progress_bar_enabled) mt-4 @endif" href="#">Skip</a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
    <script>
        window.onload=function(){
            var delay = {{ json_encode($link->delay) }};
            var delay_multiple = delay * 1000;
            var target = "//{{ $link->target }}";
            var timeleft = delay;

            var downloadTimer = setInterval(function () {
                --timeleft;
                document.getElementById('timer').innerHTML = timeleft;

                progressBar = document.getElementById('progressbar');
                progressBarLabel = document.getElementById('progress-bar-label');

                if (progressBar) {
                    progressBar.style.width = Math.round(timeleft / delay * 100) + '%';
                    progressBarLabel.innerHTML = Math.round(timeleft / delay * 100) + '%';
                }

                if (timeleft <= 0) {
                    clearInterval(downloadTimer);
                }
            }, 1000);

            var redirectTimer = setInterval(function () {
                window.location.href= target;
            }, delay_multiple);
        };
    </script>
</html>