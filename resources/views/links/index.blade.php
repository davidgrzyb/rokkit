@extends('layouts.minimal')

@section('content')
    <!-- Page Content -->
    <div class="content">
        @include('alerts.redirect-limit')
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <i class="fa fa-rocket text-muted mr-5"></i> Links
            </h2>
            <h3 class="h5 text-muted mb-0">
                Ready. Set. Redirect!
            </h3>
            <a href="{{ url('/links/create') }}" class="btn btn-lg btn-primary hidden-sm-down mt-30">
                <i class="si si-plus"></i> Create New Link
            </a>
        </div>

        @if(Session::has('message'))
            <div class="row mb-2">
                <div class="alert alert-success col-md-6 offset-md-3 text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif

        @livewire('links-table')
    </div>
    <!-- END Page Content -->
@endsection
