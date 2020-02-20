<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        return view('pages.account')->with([
            'intent' => auth()->user()->createSetupIntent(),
        ]);
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
        $method = $user->updateDefaultPaymentMethod($request->get('stripePaymentMethod'));

        if (! $user->subscribed(User::PRO_PLAN)) {
            $user->newSubscription(User::PRO_PLAN, config('plans.pro.stripe_plan_id'))->create($method->paymentMethod);
            Session::flash('message', 'Success! You have now been upgraded to a pro account.');
        } else {
            Session::flash('message', 'Success! Your default payment method has been updated.');
        }

        return redirect('/account');
    }
}
