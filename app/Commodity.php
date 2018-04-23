<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    //
    protected $fillable=[
        'name','is_selected','user_id','description','type_accumulation'
    ];
}
