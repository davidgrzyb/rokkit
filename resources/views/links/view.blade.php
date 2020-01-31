@extends('layouts.minimal')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <!-- <i class="fa fa-user text-muted mr-5"></i>  -->
                Create New Link
            </h2>
            <h3 class="h5 text-muted mb-0">
                Use the form below to create a new shortened redirect link.
            </h3>
        </div>

        <div class="block block-rounded block-fx-shadow">
            <div class="block-content">
                <form action="be_pages_real_estate_listing_new.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <!-- <h2 class="content-heading text-black">Redirect Type</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Generic Redirect links are like typical shortened urls.
                            </p>
                            <p class="text-muted">
                                Advertisement Redirect links show your advertisement during redirect.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group">
                                <div class="custom-file form">
                                    <select class="form-control form-control-lg" id="re-listing-status" name="re-listing-status">
                                        <option value="0">Select a type..</option>
                                        <option value="sale">Generic Redirect URL</option>
                                        <option value="rent">Advetisement Redirect URL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Vital Info -->
                    <h2 class="content-heading text-black">Target URL</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Where would you like the redirect to go?
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group">
                                <label for="re-listing-name">Target URL</label>
                                <input type="text" class="form-control form-control-lg" id="re-listing-name" name="re-listing-name" placeholder="ex. google.com">
                            </div>
                            <!-- <div class="form-group">
                                <label for="re-listing-address">Address</label>
                                <input type="text" class="form-control form-control-lg" id="re-listing-address" name="re-listing-address" placeholder="eg Street Name 45, NY">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <label for="re-listing-status">Status</label>
                                    <select class="form-control form-control-lg" id="re-listing-status" name="re-listing-status">
                                        <option value="0">Please select</option>
                                        <option value="sale">For Sale</option>
                                        <option value="rent">For Rent</option>
                                        <option value="unavailable">Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <label for="re-listing-price">Price</label>
                                    <input type="text" class="form-control form-control-lg" id="re-listing-price" name="re-listing-price" placeholder="eg $250,000">
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- END Vital Info -->

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

                    <!-- Contact Info -->
                    <h2 class="content-heading text-black">Content</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Would would you like your ad to say during redirect?
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group">
                                <label for="re-listing-name">Main Text</label>
                                <input type="text" class="form-control form-control-lg" id="re-listing-name" name="re-listing-name" placeholder="ex. google.com">
                                <small class="text-muted">This text will appear above the image or video that will be featured during redirect.</small>
                            </div>
                            <div class="form-group">
                                <label for="re-listing-name">Secondary Description</label>
                                <input type="text" class="form-control form-control-lg" id="re-listing-name" name="re-listing-name" placeholder="ex. google.com">
                                <small class="text-muted">This text will appear below the image or video that will be featured during redirect.</small>
                            </div>
                        </div>
                    </div>
                    <!-- END Contact Info -->

                    <!-- Contact Info -->
                    <h2 class="content-heading text-black">Content</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Where would you like your advertisement to lead to?
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group">
                                <label for="re-listing-name">Ad Target URL</label>
                                <input type="text" class="form-control form-control-lg" id="re-listing-name" name="re-listing-name" placeholder="ex. google.com">
                                <small class="text-muted">This is the link that media and text will link to on the redirect page.</small>
                            </div>
                        </div>
                    </div>
                    <!-- END Contact Info -->

                    <!-- Contact Info -->
                    <h2 class="content-heading text-black">Styling</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Select the styles you would like your ad to have.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="re-listing-name">Page Background Color</label>
                                    <div class="js-colorpicker input-group js-colorpicker-enabled colorpicker-element" data-format="hex" data-colorpicker-id="2">
                                        <input type="text" class="form-control" id="example-colorpicker2" name="example-colorpicker2" value="#42a5f5">
                                        <div class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0">
                                                <i style="background: rgb(66, 165, 245);"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="re-listing-name">Main Text Color</label>
                                    <div class="js-colorpicker input-group js-colorpicker-enabled colorpicker-element" data-format="hex" data-colorpicker-id="2">
                                        <input type="text" class="form-control" id="example-colorpicker2" name="example-colorpicker2" value="#42a5f5">
                                        <div class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0">
                                                <i style="background: rgb(66, 165, 245);"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="re-listing-name">Secondary Description Color</label>
                                    <div class="js-colorpicker input-group js-colorpicker-enabled colorpicker-element" data-format="hex" data-colorpicker-id="2">
                                        <input type="text" class="form-control" id="example-colorpicker2" name="example-colorpicker2" value="#42a5f5">
                                        <div class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0">
                                                <i style="background: rgb(66, 165, 245);"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Contact Info -->

                    <!-- Contact Info -->
                    <h2 class="content-heading text-black">Media</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                What would you like to show during the redirect?
                            </p>
                            <p class="text-muted">
                                If no image is uploaded, only the text entered above will be shown.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group">
                                <label for="re-listing-name">Image Upload</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input js-custom-file-input-enabled" id="example-file-input-custom" name="example-file-input-custom" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Contact Info -->

                    <!-- Contact Info -->
                    <h2 class="content-heading text-black">Delay</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                How long would you like the delay to be during the redirect?
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="re-listing-name">Delay (Seconds)</label>
                                    <input type="text" class="form-control form-control-lg" id="re-listing-name" name="re-listing-name" placeholder="10">
                                </div>
                                <div class="form-group col">
                                    <label for="re-listing-name">Show Progress Bar</label>
                                    <select class="form-control form-control-lg" id="re-listing-bedrooms" name="re-listing-bedrooms">
                                        <option value="0" selected>Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="re-listing-name">Show Skip Button</label>
                                    <select class="form-control form-control-lg" id="re-listing-bedrooms" name="re-listing-bedrooms">
                                        <option value="0" selected>Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </div>
                            </div>
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
