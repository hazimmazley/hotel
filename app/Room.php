<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function type()
    {
        return $this->belongsTo('App\RoomType', 'room_type_id', 'id');
    }

    public function reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }
}
