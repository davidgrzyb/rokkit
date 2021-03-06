@extends('layouts.minimal')

@section('content')
    <!-- Hero -->
    <div class="bg-white bg-pattern pt-50 pb-50" style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
        <div class="d-flex align-items-center">
            <div class="content content-full">
                <div class="row no-gutters w-100 py-100 overflow-hidden">
                    <div class="col-md-5 py-30 d-flex align-items-center invisible" data-toggle="appear">
                        <div class="text-center text-md-left">
                            <h1 class="font-w600 font-size-h2 mb-20">
                                Advertise During URL Redirects!
                            </h1>
                            <span class="d-inline-block bg-body-light rounded-pill py-5 px-15 mb-15 font-w600" style="font-size:18px;">Over {{ number_format(round($redirectsCount, -2)) }} redirects so far!</span>
                            <p class="font-size-lg nice-copy text-muted mb-30">
                                Advertise to customers during your shortened URL redirects - even using your own domain!
                            </p>
                            <a class="btn btn-hero btn-alt-secondary mb-3" href="{{ url('/demo') }}" target="_blank">
                                <i class="fa fa-link text-primary mr-5"></i> Try Demo Link
                            </a>
                            <a class="btn btn-hero btn-alt-primary mb-3" href="{{ url('/register') }}">
                                <i class="fa fa-arrow-right text-primary mr-5"></i> Sign Up For Free
                            </a>
                        </div>
                    </div>
                    <div id="demo-image" class="col-md-6 offset-md-1 d-none d-md-flex align-items-md-center justify-content-md-end invisible" data-toggle="appear" data-class="animated fadeInRight">
                        <img class="img-fluid" src="{{ asset('storage/rokkit-homepage.png') }}" alt="Rokkit Homepage Demo">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

@section('css_before')
    <style>
        #main-container {
            background-color: white;
        }

        #demo-image {
            -webkit-box-shadow: -25px 0px 31px 7px #E5E5E5; 
            box-shadow: -25px 0px 31px 7px #E5E5E5;
        }
    </style>
@endsection
