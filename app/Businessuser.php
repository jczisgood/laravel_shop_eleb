<?php

namespace App;

//use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Businessuser extends Authenticatable
{
    //
    protected $fillable=[
        'name','phone','category_id','password'
    ];

}
