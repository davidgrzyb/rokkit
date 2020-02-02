<?php

namespace App;

use Carbon\Carbon;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    const FREE_PLAN = 'free';
    const PRO_PLAN = 'pro';
    const PRO_PLAN_ID = 'plan_GePu2rvARsgJXV';
    const PLANS =[
        self::FREE_PLAN,
        self::PRO_PLAN,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function getPlanAttribute()
    {
        if (auth()->user()->subscribed(User::PRO_PLAN)) {
            return 'pro';
        }

        return 'free';
    }

    public function getPlanLimit()
    {
        return config(sprintf('plans.%s.limit', $this->plan));
    }

    public function getClicksThisMonth()
    {
        return Cache::remember('clicks_this_month_'.$this->id, now()->addMinutes(3), function () {
            return $this->links()->withCount('clicks')->get()->sum('clicks_count');
        });
    }

    public function getRedirectsThisMonth()
    {
        return Cache::remember('redirects_this_month_'.$this->id, now()->addMinutes(3), function () {
            return $this->links()->withCount('redirects')->get()->sum('redirects_count');
        });
    }

    public function getRedirectsLeft()
    {
        return Cache::remember('redirects_left_'.$this->id, now()->addMinutes(3), function () {
            return $this->getPlanLimit() - $this->getRedirectsThisMonth();
        });
    }

    public function getSubscriptionRenewalDate($plan = self::PRO_PLAN)
    {
        $sub = $this->subscription($plan)->asStripeSubscription();
        return Carbon::createFromTimeStamp($sub->current_period_end)->format('F jS, Y');
    }
}
