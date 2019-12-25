<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\CheckoutMail;
use App\Order;
use App\OrderProduct;
use App\PromoCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
class Checkout extends Controller
{
    public function indexs(){
        $carts= Cart::getContent();
        $carts=json_decode( $carts->toJson(), true );
        $total=Cart::getTotal();
        return view('site.checkout' ,compact('carts','total'));
    }


    public function saveOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'phone'=>'required  | numeric',
            'address'=>'required  ',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }else{

            if ($request->has('promo')) {
                $promo=PromoCode::where('name',$request->promo)->first();
                $current_date = Carbon::now();
                if ($promo !=null && $promo->endpromo > $current_date){
                    $code=rand ( 10000 , 99999 ).auth()->user()->id;
                    $total=Cart::getTotal();

                    $present= $promo->discount /100;
                    $all_discount=$total*$present;
                    $total_price=$total - $all_discount;

                    $order=Order::create([
                        'name' =>$request->name,
                        'phone' =>$request->phone,
                        'address' =>$request->address,
                        'total'=>$total_price,
                        'user_id'=>auth()->user()->id,
                        'code'=>$code,
                        'promo'=>$promo->name,
                        'discount'=>$promo->discount,
                    ]);

                }
                else{
                    Alert::success('your promo code is fail')->persistent(true,false);
                    return redirect()->back();
                }

            }else{
                $code=rand ( 10000 , 99999 ).auth()->user()->id;
                $total=Cart::getTotal();

                $order=Order::create([
                    'name' =>$request->name,
                    'phone' =>$request->phone,
                    'address' =>$request->address,
                    'total'=>$total,
                    'user_id'=>auth()->user()->id,
                    'code'=>$code,
                ]);
            }


                $carts= Cart::getContent();
               $carts=json_decode( $carts->toJson(), true );
                foreach ($carts as $cart){
                    OrderProduct::create([
                        'name' =>$cart['name'],
                        'product_id' =>$cart['id'],
                        'quantity' =>$cart['quantity'],
                        'price' =>$cart['price'],
                        'order_id'=>$order->id,
                    ]);
                }
                $user=auth()->user();
                $order=Order::where('code',$code)->first();
            Mail::to($user->email)->send(new CheckoutMail(['data'=>$order,'user'=>$user]));

            Alert::success('Successful booked your code is '.$code.' you must save it !')->persistent(true,false);
            session()->forget('count');
            Cart::clear();
            return redirect(route('siteHome'));
        }

    }

}
