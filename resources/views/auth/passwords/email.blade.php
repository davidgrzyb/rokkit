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
                <h1 class="h2 font-w700 mt-50 mb-10">Don’t worry, we’ve got your back</h1>
                <h2 class="h4 font-w400 text-muted mb-0">Please enter your username or email</h2>
            </div>
            <!-- END Header -->

            <!-- Reminder Form -->
            <div class="row justify-content-center px-5">
                <div class="col-sm-8 col-md-6 col-xl-4">
                    <!-- jQuery Validation functionality is initialized with .js-validation-reminder class in js/pages/op_auth_reminder.min.js which was auto compiled from _es6/pages/op_auth_reminder.js -->
                    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form class="js-validation-reminder" action="{{ route('password.email') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="email">Email</label>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                <i class="fa fa-asterisk mr-10"></i> {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Reminder Form -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
