<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $fillable = ['link_id'];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
