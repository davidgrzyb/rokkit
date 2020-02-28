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
        $id = $request->id;
        $slug = $request->slug;
        $domain = $request->domain;

        $link = Link::query()
            ->when($slug, function ($query) use ($slug) {
                return $query->where('slug', $slug);
            })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->when($domain, function ($query) use ($domain) {
                return $query->whereHas('domain', function ($query) use ($domain) {
                    return $query->where('name', $domain);
                });
            })
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
