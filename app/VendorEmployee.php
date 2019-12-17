<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class VendorEmployee extends Authenticatable
{
    use Notifiable;

    protected $guard = 'vendor';
    protected $fillable = [
        'name','phone','email','addMarket','addCategory','vendor_id','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function checkEmail($email){

        return $this->select('email')->where('email',$email)->first();
    }

    public function market()
    {
        return $this->belongsToMany('App\Market','employee_markets', 'employee_id', 'market_id');
    }
}
