<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'vendor';

    protected $fillable = [
        'name','image', 'email', 'password','fcm_token','phone',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
    public function checkEmail($email){

        return $this->select('email')->where('email',$email)->first();
    }
}
