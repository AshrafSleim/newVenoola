<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\PasswordMail;
use App\Market;
use App\User;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Alert;
use DB;

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


    public function getResetPassword(){
        return view('site.forgetpassword');
    }

    public function sendPasswordMail(Request $request){
        $validator = Validator::make($request->all(), [
            'email'               => 'required|email|string|max:255',
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }
        $input             = $request->all();
        $user=User::where('email',request('email'))->first();
        if (!empty($user)) {
            $token= app('auth.password.broker')->createToken($user);
            $data=DB::table('password_resets')->insert([
                'email'=>$user->email,
                'token'=>$token,
                'created_at'=>Carbon::now(),
            ]);
            Mail::to($input['email'])->send(new PasswordMail(['data'=>$user,'token'=>$token]));
            Alert::success('Now you can check your email to reset your password');

            return redirect()->back();
//            return response()->json(['status' => 'success', 'code' => 200, 'data' => 'Now you can check your email to reset your password']);
        } else {
            Alert::error('This email not found');

            return redirect()->back();

//            return response()->json(['status' => 'error', 'code' => 400, 'data' => 'This email not found ']);
        }
    }


    public function reset_password($token){
        $check_token= DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHour(2))->first();
        if (!empty($check_token)){
            return view('mail.reset_pasword',['data'=>$check_token]);
        }else{
            Alert::error('Sorry your token faild');

            return redirect(route('siteLogin'));        }
    }
    public function reset_password_final($token){
        $this->validate(request(),[
            'password'=>'required | confirmed',
            'password_confirmation'=>'required',
        ]);
        $check_token= DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHour(2))->first();
        if (!empty($check_token)){
            $user= User::where('email',$check_token->email)->update([
                'email'=>$check_token->email,
                'password'=>bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email',request('email'))->delete();
            Alert::success('Your password has been changed you can login now');

            return redirect(route('siteLogin'));
        }else{
            Alert::error('Sorry you must reset password again');

            return redirect(route('siteLogin'));        }
    }

}
