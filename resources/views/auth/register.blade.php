@extends('layouts.simple')

@section('content')
    <!-- Page Content -->
    <div class="bg-gd-sea">
        <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
            <!-- Header -->
            <div class="py-30 px-5 text-center">
                <a class="link-effect font-w700" href="index.html">
                    <i class="si si-rocket"></i>
                    <span class="font-size-xl text-primary-dark">rokk</span><span class="font-size-xl">it</span>
                </a>
                <h1 class="h2 font-w700 mt-50 mb-10">Create New Account</h1>
                <h2 class="h4 font-w400 text-muted mb-0">Please add your details</h2>
            </div>
            <!-- END Header -->

            <!-- Sign Up Form -->
            <div class="row justify-content-center px-5">
                <div class="col-sm-8 col-md-6 col-xl-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="name">Name</label>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="signup-email">Email</label>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="signup-password">Password</label>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label for="signup-password-confirm">Password Confirmation</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" id="signup-terms" name="signup-terms">
                                    <span class="css-control-indicator"></span>
                                    I agree to Terms &amp; Conditions
                                </label>

                                @error('signup-terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row gutters-tiny">
                            <div class="col-12 mb-10">
                                <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-success" id="register-btn">
                                    <i class="si si-user-follow mr-10"></i> {{ __('Register') }}
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" data-toggle="modal" data-target="#modal-popin">
                                    <i class="si si-book-open text-muted mr-10"></i> Read Terms
                                </button>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ url('/login') }}">
                                    <i class="si si-login text-muted mr-10"></i> Sign In
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Sign Up Form -->
        </div>
        <div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl modal-dialog-popin" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Terms &amp; Conditions</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <pre>@include('auth.terms')</pre>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                            <i class="fa fa-check"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <script>
        $('#signup-terms').change(function () {
            $('#register-btn').prop("disabled", !this.checked);
        }).change()
    </script>
@endsection
