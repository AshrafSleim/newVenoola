<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Lang extends Controller
{
    public function ar(){
        session()->forget('lang');
        session()->put('lang','ar');
        return redirect()->back();

    }
    public function en(){
        session()->forget('lang');
        session()->put('lang','en');
        return redirect()->back();

    }
    public function index($lang){
        if ($lang == 'ar'){
            session()->forget('lang');
            session()->put('lang','ar');

        }else{
            session()->forget('lang');
            session()->put('lang','en');

        }
        return redirect()->back();

    }
}
