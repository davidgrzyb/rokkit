<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->user()->subscribed(User::PRO_PLAN)) {
            return redirect()->route('account')->withMessage('Customer domains are only available with a paid membership.');
        }

        return $next($request);
    }
}
