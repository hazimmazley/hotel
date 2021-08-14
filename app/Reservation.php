<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function rooms()
    {
        return $this->belongsToMany('App\Room');
    }

    public function user(Type $var = null)
    {
        return $this->belongsTo('App\User');
    }
}
