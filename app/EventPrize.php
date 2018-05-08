<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //
    public function even()
    {
        return $this->belongsTo('App\Event','events_id');
    }
    public function member()
    {
        return $this->belongsTo('App\Businessuser','member_id');
    }
}
