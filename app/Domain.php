<?php

namespace App;

use App\Link;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name', 'user_id', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public static function search($search)
    {
        return empty($search) ? static::query() : static::where('name', 'like', '%'.$search.'%');
    }

    public function isDefault()
    {
        return $this->name === config('rokkit.default_domain');
    }

    public function isEnabled()
    {
        if ($this->name === config('rokkit.default_domain')) {
            return true;
        }

        $records = collect(dns_get_record("dgrzyb.me"));
        if ($records->where('type', 'A') === config('rokkit.default_domain')) {
            return true;
        }

        return false;
    }
}
