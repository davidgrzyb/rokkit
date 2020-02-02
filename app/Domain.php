<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name', 'user_id', 'created_at', 'updated_at',
    ];

    public function links()
    {
        return $this->hasMany(Link::app);
    }

    public static function search($search)
    {
        return empty($search) ? static::query()  : static::where('name', 'like', '%'.$search.'%');
    }
}
