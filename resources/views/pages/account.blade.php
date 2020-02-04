@extends('layouts.minimal')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <i class="fa fa-user text-muted mr-5"></i> My Account
            </h2>
            <h3 class="h5 text-muted mb-0">
                Manage your account using the forms below.
            </h3>
        </div>

        @if(Session::has('message'))
            <div class="row mb-2">
                <div class="alert alert-success col-md-6 offset-md-3 text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif

        @php
            $progress = round(auth()->user()->getRedirectsThisMonth() / auth()->user()->getPlanLimit());
        @endphp

        @if(! auth()->user()->subscribed(\App\User::PRO_PLAN))
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Redirect Usage
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row align-items-center">
                        <div class="col-sm-6 py-10">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="font-size-sm font-w500 mb-0">
                                <span class="font-w600">{{ number_format(auth()->user()->getRedirectsThisMonth()) }}</span> of <span class="font-w600">{{ number_format(auth()->user()->getPlanLimit()) }}</span> redirects per month.
                            </p>
                        </div>
                        <div class="col-sm-6 py-10 text-md-right">
                            <a class="btn btn-md btn-success btn-rounded mr-5 my-5" href="#upgrade">
                                <i class="si si-check mr-5"></i> Upgrade to Pro
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row row-deck">
                <div class="col-md-4">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-user fa-fw mr-5 text-muted"></i> Account
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="mb-5">
                                <strong>Start Date:</strong> {{ Carbon\Carbon::parse(auth()->user()->created_at)->format('F jS, Y') }}
                            </p>
                            <p>
                                <strong>Plan:</strong> {{ ucfirst(auth()->user()->plan) }} Plan
                            </p>
                            <button type="button" class="btn btn-sm btn-alt-warning mr-5">
                                Downgrade
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-danger">
                                Close Account
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-dollar fa-fw mr-5 text-muted"></i> Billing Cycle
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="mb-5">
                                Your next billing date is <strong>{{ auth()->user()->getSubscriptionRenewalDate() }}</strong>. Your redirect usage will reset on this day.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="si si-refresh mr-5 text-muted"></i> Redirect Limit
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="mb-5">
                                <strong>{{ number_format(auth()->user()->getRedirectsThisMonth()) }}</strong> of {{ number_format(auth()->user()->getPlanLimit()) }} redirects used.
                            </p>
                            <div class="progress push">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    <span class="progress-bar-label">{{ $progress }}%</span>
                                </div>
                            </div>
                            <a href="{{ url('/links') }}" class="btn btn-sm btn-alt-primary mr-5">
                                View Links
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="block block-rounded block-fx-shadow">
            <div class="block-content">
                <form action="{{ url('/account/update') }}" method="POST">
                    @csrf
                    <!-- Account Info -->
                    <h2 class="content-heading text-black">Account Info</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Please use this form to update your current account info.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="re-listing-name">Name</label>
                                <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="re-listing-address">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" id="email" value="{{ auth()->user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="re-listing-address">Password</label>
                                <input type="password" class="form-control form-control-lg" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="re-listing-address">Confirm Password</label>
                                <input type="password" class="form-control form-control-lg" name="confirm_password" id="confirm_password">
                            </div>
                        </div>
                    </div>
                    <!-- END Vital Info -->

                    <!-- Form Submission -->
                    <div class="row items-push pt-50 pb-30">
                        <div class="col-md-11">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary float-right text-white">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Form Submission -->
                </form>
            </div>
        </div>


        <div class="block block-rounded block-fx-shadow" id="upgrade">
            <div class="block-content pb-50">
                <!-- Contact Info -->
                @if(! auth()->user()->subscribed(\App\User::PRO_PLAN))
                    <h2 class="content-heading text-black">Upgrade</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Please use this form to enter a payment method and upgrade. Cancel any time.
                                <br><br>
                                <a href="#">Check out the pro plan feature here!</a>
                            </p>
                        </div>
                @else
                    <h2 class="content-heading text-black">Default Payment Method</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Please use this form to update your default payment method.
                            </p>
                        </div>
                @endif
                    <div class="col-lg-7 offset-lg-1">
                        <form method="post" action="{{ url('/account/upgrade') }}" id="payment-form">
                            @csrf
                            <div class="form form-cb row">           
                                <input type="hidden" id="card-holder-name" value="{{ auth()->user()->email }}">           
                                <div id="card-element" class="col-md-10">
                                <!-- A Stripe Element will be inserted here. -->           
                                </div>

                                <div class="col-md-2">
                                    <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-primary mt-1">Upgrade</button>
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Contact Info -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('css_before')
    <style>
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 2px solid #e6ebf1;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection

@section('js_after')
    @parent
    
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
    </script>

    <script>
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                console.log('error');
            } else {
                stripePaymentHandler(setupIntent);
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
        });

        // Submit the form with the token ID.
        function stripePaymentHandler(setupIntent) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripePaymentMethod');
            hiddenInput.setAttribute('value', setupIntent.payment_method);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection
