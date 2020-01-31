<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
