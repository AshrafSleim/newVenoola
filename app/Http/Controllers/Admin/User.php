<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
class User extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'user');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $users = $query->orderBy('id', 'desc')->paginate(10);
            $users->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&email=" . $request->email .
                "&mobile=" . $request->mobile
                );
        } else {
            $users = \App\User::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.users', compact('users'));
    }

    public function returnSearchResult($request)
    {
        $name               = $request->name;
        $email              = $request->email;
        $mobile             = $request->mobile;
        $users              = \App\User::query();
        $users->where(function ($query) use ($name, $email, $mobile) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($email) {
                $query->where('email', 'LIKE', ['%' . $email . '%']);
            }
            if ($mobile) {
                $query->where('phone', 'LIKE', ['%' . $mobile . '%']);
            }
            return $query;
        });

        return $users;
    }


    public function delete($id)
    {
        \App\User::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function getNotification(){
        session()->forget('menu');
        session()->put('menu', 'notification');
        return view('admin.notification');
    }

    public function pushNotification(Request $request){
        $messages=$request->message;
        fcm($messages);
        Alert::success('Successful delete !');
        return redirect()->back();
    }

}
