<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const STATUSES = [
        self::STATUS_ENABLED,
        self::STATUS_DISABLED,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function redirects()
    {
        return $this->hasMany(Redirect::class);
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }

    public function getUrlAttribute()
    {
        return $this->domain->name . '/' . $this->slug;
    }

    public function getRedirectsCount()
    {
        return Cache::remember('redirects_count_'.$this->id, now()->addMinutes(3), function () {
            return $this->redirects->count();
        });
    }

    public function getClicksCount()
    {
        return Cache::remember('clicks_count_'.$this->id, now()->addMinutes(3), function () {
            return $this->clicks->count();
        });
    }

    public function isDefault()
    {
        return $this->domain->name === config('rokkit.default_domain');
    }

    public function isEnabled()
    {
        if (! $this->enabled) {
            return false;
        }

        if (! $this->domain_id) {
            return false;
        }

        if (! $this->domain->isEnabled()) {
            return false;
        }

        return true;
    }

    public function isAdRedirect()
    {
        return $this->ad_target !== '';
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::whereHas('domain', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orWhere('slug', 'like', '%'.$search.'%')
                ->orWhere('target', 'like', '%'.$search.'%')
                ->orWhere('ad_target', 'like', '%'.$search.'%');
    }
}
