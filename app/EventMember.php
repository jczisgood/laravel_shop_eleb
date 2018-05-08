<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    //
    protected $fillable=[
        'member_id','events_id'
    ];
}
