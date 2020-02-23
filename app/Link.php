<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'domain_id',
        'user_id',
        'slug',
        'target',
        'enabled',
        'image',
        'main_text',
        'secondary_text',
        'ad_target',
        'delay',
        'progress_bar_enabled',
        'skip_button_enabled',
        'bg_color',
        'main_text_color',
        'secondary_text_color',
    ];

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

    public function resetAdvertisementColumns()
    {
        $this->image = null;
        $this->main_text = null;
        $this->secondary_text = null;
        $this->ad_target = '';
        $this->delay = 0;
        $this->progress_bar_enabled = true;
        $this->skip_button_enabled = false;
        $this->bg_color = null;
        $this->main_text_color = null;
        $this->secondary_text_color = null;

        return $this;
    }

    public static function generateSlug()
    {
        do {
            $slug = substr(md5(rand()), 0, 7);
        } while (Link::where('slug', $slug)->exists());

        return $slug;
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
