@extends('layouts.minimal')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <!-- <i class="fa fa-user text-muted mr-5"></i>  -->
                Add New Custom Domain
            </h2>
            <h3 class="h5 text-muted mb-0">
                Your domain must be <a href="#" target="_blank">properly configured</a> first.
            </h3>
        </div>

        <div class="block block-rounded block-fx-shadow">
            <div class="block-content">
                <form action="#" method="POST">
                    @csrf
                    <!-- Domain Info -->
                    <h2 class="content-heading text-black">Domain</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Set the domain you would like to use for your short links.
                                <br><br>
                                To setup your domain to work with rokk.it please consult <a href="" target="_blank">these instructions</a>.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" id="domain" name="domain" placeholder="ex. yourdomain.com" value="{{ $domain->name }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Domain Info -->
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
