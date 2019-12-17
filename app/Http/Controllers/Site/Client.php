<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Market;
use App\User;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Alert;
class Client extends Controller
{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function showClientRegisterForm()
    {
        $last_url=url()->previous();
        return view('site.client',compact('last_url'));
    }
    protected function createClient(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric','digits_between:8,15'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();
        // dd($request->email);
        if ($this->userModel->checkEmail($request->email)) {
            Alert::error('This email already registered.You can login !');
            return back()->withErrors('This email already registered.You can login')->withInput($request->except('password'));
        }
        else {
            $user=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                Alert::success('Successful register !');
//                return redirect($request->last_url);
                return redirect(route('siteHome'));
            }
            Alert::error('you must register agin !');
            return back()->withErrors('This email already registered.You can login')->withInput($request->except('password'));

        }
    }

    public function showClintLoginForm()
    {
        $last_url=url()->previous();
        return view('site.login',compact('last_url'));
    }
    protected function loginClint(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return redirect(route('siteHome'));

//            return redirect($request->last_url);
        }
        Alert::error('Your email or password not correct !');
        return back()->withErrors('Your email or password not correct')->withInput($request->only('email'));
    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('siteHome'));
    }
}
