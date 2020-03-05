<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = ['user_id', 'description', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
