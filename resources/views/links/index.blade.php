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

        @livewire('links-table')
    </div>
    <!-- END Page Content -->
@endsection
