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
                Your domain must be <a href="#" id="domain-instructions-url">properly configured</a> first.
            </h3>
        </div>

        <div class="block block-rounded block-fx-shadow">
            <div class="block-content">
                <form action="{{ url('/domains/store') }}" method="POST">
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
                                    <input type="text" class="form-control form-control-lg" id="domain" name="domain" placeholder="ex. yourdomain.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Domain Info -->

                    <!-- Form Submission -->
                    <div class="row items-push pt-30 pb-30">
                        <div class="col-md-11">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary float-right">
                                    Add Domain
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Form Submission -->
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('js_after')
    @parent

    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}" aria-hidden="true"></script>
    <script>
        $('#domain-instructions-url').click(function(e) {
            Swal.fire({
                title: 'Creating CNAME Records',
                text: "{{ config('rokkit.domain_instructions') }}",
                icon: 'info',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay, got it!'
            });
        });
    </script>
@endsection
