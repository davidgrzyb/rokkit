<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        $redirectsThisMonth = Cache::remember('redirects-this-month-'.auth()->user()->id, now()->addMinutes(5), function () {
            return auth()->user()->getRedirectsThisMonth();
        });

        $planLimit = Cache::remember('plan-limit-'.auth()->user()->id, now()->addMinutes(5), function () {
            return auth()->user()->getPlanLimit();
        });

        $progress = round($redirectsThisMonth / $planLimit);

        return view('pages.account')
            ->withIntent(auth()->user()->createSetupIntent())
            ->withRedirectsThisMonth($redirectsThisMonth)
            ->withPlanLimit($planLimit)
            ->withProgress($progress);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'confirm_password' => ['nullable', 'string', 'required_with:password', 'same:password'],
        ]);

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->input('password') !== '') {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect('/account')->withMessage('Your account has been updated successfully!');
    }

    public function upgrade(Request $request)
    {
        $user = auth()->user();

        if (! $user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        $method = $user->updateDefaultPaymentMethod($request->get('stripePaymentMethod'));

        if (! $user->subscribed(User::PRO_PLAN)) {
            $user->newSubscription(User::PRO_PLAN, config('plans.pro.stripe_plan_id'))->create($method->paymentMethod);
            Session::flash('message', 'Success! You have now been upgraded to a pro account.');
        } else {
            Session::flash('message', 'Success! Your default payment method has been updated.');
        }

        return redirect('/account');
    }

    public function downgrade(Request $request)
    {
        if (auth()->user()->subscribed(User::PRO_PLAN)) {
            auth()->user()->subscription(User::PRO_PLAN)->cancelNow();
            Session::flash('message', 'Your account has been downgraded to the free plan 😔');
        }

        return redirect('/account');
    }
}
