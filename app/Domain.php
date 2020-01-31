<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public function links()
    {
        return $this->hasMany(Link::app);
    }
}
