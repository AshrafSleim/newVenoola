<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name','phone','address','code','user_id','total','pay','promo','discount',
    ];

}
