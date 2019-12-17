<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Cart;
use Alert;
use Illuminate\Support\Facades\Auth;
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

            Alert::success('Successful booked your code is '.$code.' you must save it !')->persistent(true,false);
            session()->forget('count');
            Cart::clear();
            return redirect(route('siteHome'));
        }

    }

}
