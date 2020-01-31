<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function getPlanLimit()
    {
        return config(sprintf('plans.%s.limit', $this->plan));
    }

    public function getRedeemsThisMonth()
    {
        // TODO: Finish this.
        return 250000;
    }

    public function getRedeemsLeft()
    {
        return $this->getPlanLimit() - $this->getRedeemsThisMonth();
    }
}
