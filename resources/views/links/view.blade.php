@extends('layouts.minimal')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                {{ $link->url }}
                <i class="fa fa-long-arrow-right mr-3 ml-3"></i> 
                {{ $link->target }}
            </h2>
            <!-- <h3 class="h5 text-muted mb-0">
                Manage this link below.
            </h3> -->
        </div>

        @if(Session::has('message'))
            <div class="row mb-2">
                <div class="alert alert-success col-md-6 offset-md-3 text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="row mb-2">
                <div class="alert alert-danger col-md-6 offset-md-3 text-center" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="block block-rounded block-fx-shadow">
            <div class="block-content">
                <form action="{{ url('/links/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="link-id" value="{{ $link->id }}">

                    <!-- Enabled Info -->
                    <h2 class="content-heading text-black">Link Status</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Enable or disable the link.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <label class="css-control css-control-success css-switch">
                                <input type="checkbox" class="css-control-input" name="enabled" id="enabled" @if($link->enabled) checked @endif>
                                <span class="css-control-indicator"></span> <span id="enabled-status">Enabled</span>
                            </label>
                        </div>
                    </div>
                    <!-- END Enabled Info -->

                    <!-- Target URL Info -->
                    <h2 class="content-heading text-black">Target URL</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Where would you like the redirect to go?
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group">
                                <label for="target-url">Target URL *</label>
                                <input type="text" class="form-control form-control-lg" id="target-url" name="target-url" placeholder="ex. google.com" value="{{ $link->target }}">
                            </div>
                        </div>
                    </div>
                    <!-- END Target URL Info -->

                    <!-- Domain & Link Info -->
                    <h2 class="content-heading text-black">Domain & Link</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Set the domain & slug for your new link.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <label for="domain">Domain *</label>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="domain-id" name="domain-id" @if(! auth()->user()->subscribed(\App\User::PRO_PLAN)) disabled @endif>
                                    @foreach($domains as $domain)
                                        <option value="{{ $domain->id }}" @if($link->domain_id === $domain->id) selected @endif>{{ $domain->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">The free plan does not include custom domain functionality. <a href="{{ url('/account') }}" target="_blank">Upgrade your plan here.</a></small>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:1.15em;">
                                            {{ $link->domain->name }}/
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="slug" name="slug" placeholder="slug" value="{{ $link->slug }}">
                                </div>
                                <small class="text-muted">Leaving this field blank will automatically generate a unique slug.</small>
                            </div>
                        </div>
                    </div>
                    <!-- END Domain & Link Info -->

                    <!-- Advertising Info -->
                    <h2 class="content-heading text-black">Advertising</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Would you like to enable advertising?
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <label class="css-control css-control-success css-switch">
                                <input type="checkbox" class="css-control-input" name="advertising-enabled" id="advertising-enabled" value="true" @if($link->isAdRedirect()) checked @endif>
                                <span class="css-control-indicator"></span> <span id="advertising-status">Enabled</span>
                            </label>
                        </div>
                    </div>
                    <!-- END Advertising Info -->

                    <div id="advetising-form">

                        <!-- Content -->
                        <h2 class="content-heading text-black">Content</h2>
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    Would would you like your ad to say during redirect?
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="form-group">
                                    <label for="main-text">Main Text *</label>
                                    <input type="text" class="form-control form-control-lg" id="main-text" name="main-text" value="{{ $link->main_text }}">
                                    <small class="text-muted">This text will appear above the image or video that will be featured during redirect.</small>
                                </div>
                                <div class="form-group">
                                    <label for="secondary-text">Secondary Description</label>
                                    <textarea rows="4" class="form-control form-control-lg" id="secondary-text" name="secondary-text">{{ $link->secondary_text }}</textarea>
                                    <small class="text-muted">This text will appear below the image or video that will be featured during redirect.</small>
                                </div>
                            </div>
                        </div>
                        <!-- END Content -->

                        <!-- Ad Target -->
                        <h2 class="content-heading text-black">Ad Target</h2>
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    Where would you like your advertisement to lead to?
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="form-group">
                                    <label for="ad-target">Ad Target URL *</label>
                                    <input type="text" class="form-control form-control-lg" id="ad-target" name="ad-target" placeholder="ex. mystore.com/shop" value="{{ $link->ad_target }}">
                                    <small class="text-muted">This is the link that media and text will link to on the redirect page.</small>
                                </div>
                            </div>
                        </div>
                        <!-- END Ad Target -->

                        <!-- Styling -->
                        <h2 class="content-heading text-black">Styling</h2>
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    Select the styles you would like your ad to have. If not entered, the colors will default to #000000 (black).
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="page-bg-color">Page Background Color</label>
                                        <div class="js-colorpicker input-group js-colorpicker-enabled colorpicker-element" id="page-bg-color-picker" data-format="hex" data-colorpicker-id="1">
                                            <input type="text" class="form-control" id="page-bg-hex" name="page-bg-hex" placeholder="Hex Code" value="{{ $link->bg_color }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0">
                                                    <i style="background: {{ $link->main_text_color ?? '#42a5f5' }};"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label for="main-text-hex">Main Text Color</label>
                                        <div class="js-colorpicker input-group js-colorpicker-enabled colorpicker-element" id="main-text-color-picker" data-format="hex" data-colorpicker-id="2">
                                            <input type="text" class="form-control" id="main-text-hex" name="main-text-hex" placeholder="Hex Code" value="{{ $link->main_text_color }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0">
                                                    <i style="background: {{ $link->main_text_color ?? '#42a5f5' }};"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label for="secondary-text-hex">Secondary Description Color</label>
                                        <div class="js-colorpicker input-group js-colorpicker-enabled colorpicker-element" id="secondary-text-color-picker" data-format="hex" data-colorpicker-id="3">
                                            <input type="text" class="form-control" id="secondary-text-hex" name="secondary-text-hex" placeholder="Hex Code" value="{{ $link->secondary_text_color }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0">
                                                    <i style="background: {{ $link->main_text_color ?? '#42a5f5' }};"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Styling -->

                        <!-- Media -->
                        <h2 class="content-heading text-black">Media</h2>
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    What would you like to show during the redirect?
                                </p>
                                <p class="text-muted">
                                    If no image is uploaded, only the text entered above will be shown.
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                @if($link->image)
                                    <img class="pb-30" style="max-width:100%;" src="{{ asset('storage/'.$link->image) }}">
                                @endif
                                <div class="form-group">
                                    <label for="re-listing-name">@if($link->image) Replace Image @else Upload Image @endif</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled" id="image" name="image" data-toggle="custom-file-input">
                                        <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Media -->

                        <!-- Options -->
                        <h2 class="content-heading text-black">Options</h2>
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    How long would you like the delay to be during the redirect? (maximum 30 seconds)
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="delay">Delay (Seconds) *</label>
                                        <input type="text" class="form-control form-control-lg" id="delay" name="delay" placeholder="10" value="{{ $link->delay }}">
                                    </div>
                                    <div class="form-group col">
                                        <label for="show-progress-bar">Show Progress Bar *</label>
                                        <select class="form-control form-control-lg" id="show-progress-bar" name="show-progress-bar">
                                            <option value="1" @if($link->progress_bar_enabled) selected @endif>Yes</option>
                                            <option value="0" @if(! $link->progress_bar_enabled) selected @endif>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="show-skip-button">Show Skip Button *</label>
                                        <select class="form-control form-control-lg" id="show-skip-button" name="show-skip-button">
                                            <option value="1" @if($link->skip_button_enabled) selected @endif>Yes</option>
                                            <option value="0" @if(! $link->skip_button_enabled) selected @endif>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Options -->

                    </div>

                    <!-- Submit -->
                    <div class="row items-push pt-50 pb-30">
                        <div class="col-md-11">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary float-right ml-3">
                                    Update Link
                                </button>
                                <!-- <a type="submit" class="btn btn-lg btn-outline-primary float-right">
                                    Preview
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <!-- END Submit -->
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        jQuery(function(){
            Codebase.helpers('colorpicker');
        });
    </script>
    <script>
        $('#advertising-enabled').change(function () {
            if (this.checked) {
                $('#advetising-form').show();
                $('#advertising-status').text('Enabled');
            }
            else {
                $('#advetising-form').hide();
                $('#advertising-status').text('Disabled');
            }
        }).change()

        $('#enabled').change(function () {
            if (this.checked) {
                $('#enabled-status').text('Enabled');
            }
            else {
                $('#enabled-status').text('Disabled');
            }
        }).change()
    </script>
    <script>
        $(function() {
            $('#page-bg-color-picker').colorpicker({
                popover: true,
                container: '#demo'
                // default: "42a5f5",
            });

            $('#main-text-color-picker').colorpicker({
                popover: true,
                container: '#demo'
            });

            $('#secondary-text-color-picker').colorpicker({
                popover: true,
                container: '#demo'
            });
        });
    </script>
@endsection
