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

    public function getActiveLinks()
    {
        return $this->links()->where('enabled', true)->get();
    }

    public function getInactiveLinks()
    {
        return $this->links()->where('enabled', false)->get();
    }

    public function getPlanAttribute()
    {
        return $this->subscribed(User::PRO_PLAN) ? User::PRO_PLAN : User::FREE_PLAN;
    }

    public function isInGoodStanding()
    {
        return Cache::remember('account-standing-'.$this->id, now()->addMinutes(30), function () {
            return $this->getRedirectsLeft() > 0;
        });
    }

    public function getPlanLimit()
    {
        return config(sprintf('plans.%s.limit', $this->plan));
    }

    public function getRedirectsLeft()
    {
        return $this->getPlanLimit() - $this->getRedirectsThisMonth();
    }

    public function getClicksThisMonth()
    {
        return $this->links()->withCount('clicks')->get()->sum('clicks_count');
    }

    public function getRedirectsThisMonth()
    {
        return $this->links()->withCount('redirects')->get()->sum('redirects_count');
    }

    public function getSubscriptionRenewalDate($plan = self::PRO_PLAN)
    {
        $sub = $this->subscription($plan)->asStripeSubscription();
        return Carbon::createFromTimeStamp($sub->current_period_end)->format('F jS, Y');
    }
}
