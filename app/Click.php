<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
