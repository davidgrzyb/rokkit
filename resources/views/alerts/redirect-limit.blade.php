@php
    $user = auth()->user();
@endphp

@if($user->getRedirectsLeft() <= 1000)
    <div wire:ignore class="row" id="redeem-limit-row">
        <div class="col-md-8 offset-md-2">
            <div class="alert @if($user->getRedirectsLeft() <= 0) alert-danger @else alert-warning @endif alert-dismissable text-center" role="alert">
                <button id="redirect-notification-dismiss-btn" type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="alert-heading font-size-h4 font-w400">Redirect Limit Reached</h3>
                <p class="mb-0">
                    @if($user->getRedirectsLeft() <= 0)
                        You have reached the redirect limit for your account. 
                    @else
                        Your account is close to the monthly redirect limit for your account. 
                    @endif

                    @if(! $user->subscribed(\App\User::PRO_PLAN))
                        <a class="alert-link" href="{{ url('/account#upgrade') }}">Upgrade to a pro account to remove this limit</a>.
                    @else
                        Once your redirects run out you will be billed $5 for every additional 1 million redirects.
                    @endif
                </p>
            </div>
        </div>
    </div>
@endif

@section('js_after')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha256-1A78rJEdiWTzco6qdn3igTBv9VupN3Q1ozZNTR4WE/Y=" crossorigin="anonymous"></script>
    <script>
        if (typeof $.cookie('redirect-notification-dismissed-{{ $user->email }}') !== 'undefined'){
            $('#redeem-limit-row').hide();
        }

        $('#redirect-notification-dismiss-btn').on('click', function() {
            var date = new Date();
            var minutes = 30;
            date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie('redirect-notification-dismissed-{{ $user->email }}', 1, { expires : date });
        });
    </script>
@endsection