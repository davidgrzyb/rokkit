@extends('layouts.simple')

@section('content')
    <!-- Page Content -->
    <div class="bg-gd-sea">
        <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
            <!-- Header -->
            <div class="py-30 px-5 text-center">
                <a class="link-effect font-w700" href="{{ url('/') }}">
                    <i class="si si-rocket"></i>
                    <span class="font-size-xl text-primary-dark">rokk</span><span class="font-size-xl">it</span>
                </a>
                <h1 class="h2 font-w700 mt-50 mb-10">Welcome to Rokkit!</h1>
                <h2 class="h4 font-w400 text-muted mb-0">Please sign in</h2>
            </div>
            <!-- END Header -->

            <!-- Sign In Form -->
            <div class="row justify-content-center px-5">
                <div class="col-sm-8 col-md-6 col-xl-4">
                    <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form method="POST" action="{{ route('login') }}" class="js-validation-signin">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="email">Email</label>

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <label for="login-password">Password</label>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row gutters-tiny">
                            <div class="col-12 mb-10">
                                <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                    <i class="si si-login mr-10"></i> Sign In
                                </button>
                            </div>
                            <div class="col-sm-6 mb-5">
                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ url('/register') }}">
                                    <i class="fa fa-plus text-muted mr-5"></i> New Account
                                </a>
                            </div>
                            <div class="col-sm-6 mb-5">
                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ route('password.request') }}">
                                    <i class="fa fa-warning text-muted mr-5"></i> Forgot password
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Sign In Form -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
