<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    //
    protected $fillable=[
        'name','goods_img','goods_price','description','tips','user_id'
    ];
}
