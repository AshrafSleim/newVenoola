<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Market;
use App\Vendor;
use App\VendorEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Alert;

class AuthEmployee extends Controller
{
    public function showEmployeeLoginForm()
    {
        return view('employee.login');
    }

    public function login(Request $request){
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();
        if (Auth::guard('employee')->attempt(['email' => request('email'), 'password' => request('password')])) {
            return redirect(route('EmployeeMarket.index',auth()->guard('employee')->user()->id));
        }
        Alert::error('Your email or password not correct !');
        return back()->withErrors('Your email or password not correct')->withInput($request->only('email'));
    }

    public function logout(Request $request) {
        Auth::guard('employee')->logout();
        return view('employee.login');
    }

}
