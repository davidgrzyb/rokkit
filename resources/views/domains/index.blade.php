@extends('layouts.minimal')

@section('content')
    <!-- Page Content -->
    <div class="content">
        @include('alerts.redirect-limit')
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <i class="si si-list text-muted mr-5"></i> Domains
            </h2>
            <h3 class="h5 text-muted mb-0">
                Add custom domains to use in redirects!
            </h3>
            <a href="{{ url('/domains/create') }}" class="btn btn-lg btn-primary hidden-sm-down mt-30">
                <i class="si si-plus"></i> Add New Domain
            </a>
        </div>
        <!-- <div class="block border-bottom">
            <div class="block-content block-content-full border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 py-10">
                        <h3 class="h4 text-muted font-w400 mb-0">
                            Need a new redirect link?
                        </h3>
                    </div>
                    <div class="col-sm-6 py-10 text-md-right">
                        <a class="btn btn-md btn-primary btn-rounded my-5" href="javascript:void(0)">
                            <i class="si si-plus mr-5"></i> Create New Link
                        </a>
                    </div>
                </div>
            </div>
        </div> -->

        <form class="push" action="be_ui_icons.php" method="post">
            <div class="input-group input-group-lg">
                <input type="text" class="js-icon-search form-control" placeholder="Search links...">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </form>

        <div class="block border-bottom">
            <div class="block-content block-content-full border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 py-10">
                        <h3 class="h4 text-muted font-w400 mb-0">
                            <i class="fa fa-circle text-success mr-5"></i> dgrzyb.me
                        </h3>
                    </div>
                    <div class="col-sm-6 py-10 text-md-right">
                        <a class="btn btn-md btn-outline-secondary btn-rounded my-5" href="javascript:void(0)">
                            <i class="fa fa-wrench mr-5"></i> Manage
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 py-10">
                        <h3 class="h4 text-muted font-w400 mb-0">
                            <i class="fa fa-circle text-danger mr-5"></i> domain2.com
                        </h3>
                    </div>
                    <div class="col-sm-6 py-10 text-md-right">
                        <a class="btn btn-md btn-outline-secondary btn-rounded my-5" href="javascript:void(0)">
                            <i class="fa fa-wrench mr-5"></i> Manage
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 py-10">
                        <h3 class="h4 text-muted font-w400 mb-0">
                            <i class="fa fa-circle text-success mr-5"></i> testweb.ca
                        </h3>
                    </div>
                    <div class="col-sm-6 py-10 text-md-right">
                        <a class="btn btn-md btn-outline-secondary btn-rounded my-5" href="javascript:void(0)">
                            <i class="fa fa-wrench mr-5"></i> Manage
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 py-10">
                        <h3 class="h4 text-muted font-w400 mb-0">
                            <i class="fa fa-circle text-warning mr-5"></i> wow.me
                        </h3>
                    </div>
                    <div class="col-sm-6 py-10 text-md-right">
                        <a class="btn btn-md btn-outline-secondary btn-rounded my-5" href="javascript:void(0)">
                            <i class="fa fa-wrench mr-5"></i> Manage
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-3 pb-4">
            <div class="col-md-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg float-right">
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                <span aria-hidden="true">
                                    <i class="fa fa-angle-left"></i>
                                </span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0)">3</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                <span aria-hidden="true">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
