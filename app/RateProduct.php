<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateProduct extends Model
{
    protected $fillable = [
        'user_id','product_id','rate'
    ];
}
