<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','nameAr','image', 'vendor_id','market_id','category','counter','price','age','type','brand_id','relation_id','event_id','active'
    ];
    public function categories()
    {
        return $this->belongsTo('App\Gategory','category');
    }
    public function market()
    {
        return $this->belongsTo('App\Market','market_id');
    }
    public function event()
    {
        return $this->belongsTo('App\Event','event_id');
    }
    public function relation()
    {
        return $this->belongsTo('App\Relation','relation_id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand','brand_id');
    }

}
