<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Market;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Alert;
class AuthVendor extends Controller
{
    private $vendorModel;
    public function __construct(Vendor $vendorModel)
    {
        $this->vendorModel = $vendorModel;
    }
    public function showVendorRegisterForm()
    {
        return view('site.vendor');
    }
    protected function createVendor(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric','digits_between:8,15'],
            'password' => ['required', 'string', 'min:6'],
            'market' => ['required', 'string', 'max:255'],
            'image' => ['required'],

        ])->validate();
       // dd($request->email);
        if ($this->vendorModel->checkEmail($request->email)) {
            Alert::error('This email already registered.You can login !');

            return back()->withErrors('This email already registered.You can login')->withInput($request->except('password'));

        }
        else {
            if ($request->hasFile('image')) {
                $image    = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads"), $new_name);
            } else {
                $new_name = "";
            }

           $vendor=Vendor::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'image'=>$new_name
            ]);
//            dd($vendor->id);
            Market::create([
                'name' => $request->market,
                'image'=>$new_name,
                'phone' => $request->phone,
                'vendor_id'=>$vendor->id,
            ]);
            Alert::success('Successful register !');

        return $this->showVendorLoginForm();
        }
    }

    public function showVendorLoginForm()
    {
        return view('userVendor.login');
    }
    protected function loginVendor(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();
        if (Auth::guard('vendor')->attempt(['email' => request('email'), 'password' => request('password')])) {
            return redirect(route('VendorMarket.index',auth()->guard('vendor')->user()->id));
        }
        Alert::error('Your email or password not correct !');
        return back()->withErrors('Your email or password not correct')->withInput($request->only('email'));
    }


    public function logout(Request $request) {
        Auth::guard('vendor')->logout();
        return $this->showVendorLoginForm();
    }


}
