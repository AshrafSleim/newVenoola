<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'name','image', 'vendor_id', 'phone','active'
    ];
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
