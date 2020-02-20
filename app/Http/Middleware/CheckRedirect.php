<?php

namespace App\Http\Middleware;

use Closure;
use App\Link;

class CheckRedirect
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
        $link = Link::query()
            ->where('slug', $request->path())
            ->with([
                'user',
                'domain',
            ])
            ->firstOrFail();
        
        if (! $link->user->isInGoodStanding()) {
            LimitReachedJob::dispatch($link->user);
            return redirect('/');
        } elseif (! $link->isEnabled()) {
            return redirect('/');
        }

        return $next($request);
    }
}
