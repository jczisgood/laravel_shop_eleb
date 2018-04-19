<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopUser extends Model
{
    //
    protected $fillable=[
        'name','password','phone','category_id'
    ];
    public function category()
    {
//        return $this->belongsTo(shop_category::class,'category_id');
    }
}

