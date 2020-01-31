@extends('layouts.minimal')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <!-- <i class="fa fa-user text-muted mr-5"></i>  -->
                Add New Domain
            </h2>
            <h3 class="h5 text-muted mb-0">
                Add a domain to use for redirects below. Domain but be <a href="#">properly pointed at Rokkit</a> first.
            </h3>
        </div>

        <div class="block block-rounded block-fx-shadow">
            <div class="block-content">
                <form action="be_pages_real_estate_listing_new.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">

                    <!-- Additional Info -->
                    <h2 class="content-heading text-black">Domain & Link</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Set the domain & slug for your new link.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <label for="re-listing-bedrooms">Domain</label>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="re-listing-bedrooms" name="re-listing-bedrooms" disabled>
                                    <option value="0" selected>rokk.it</option>
                                    <option value="1">dgrzyb.me</option>
                                    <option value="2">domain2.com</option>
                                    <option value="3">wow.me</option>
                                    <option value="4">goggle.ca</option>
                                </select>
                                <small class="text-muted">The free plan does not include custom domain functionality. <a href="#">Upgrade your plan here.</a></small>
                            </div>
                            <div class="form-group">
                                <label for="re-listing-description">Slug</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:1.15em;">
                                            rokk.it/
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="example-input1-group1" name="example-input1-group1" placeholder="slug">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Additional Info -->

                    <!-- Contact Info -->
                    <h2 class="content-heading text-black">Advertising</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Would you like to enable advertising?
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <label class="css-control css-control-success css-switch">
                                <input type="checkbox" class="css-control-input" checked="">
                                <span class="css-control-indicator"></span> <span id="advertising-status">Enabled</span>
                            </label>
                        </div>
                    </div>
                    <!-- END Contact Info -->

                    <!-- Form Submission -->
                    <div class="row items-push pt-50 pb-30">
                        <div class="col-md-11">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-success float-right ml-3">
                                    Create Link
                                </button>
                                <button type="submit" class="btn btn-lg btn-outline-success float-right">
                                    View Preview
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
