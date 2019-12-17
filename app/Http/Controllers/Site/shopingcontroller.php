<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Product;

class shopingcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts= Cart::getContent();
        $total=Cart::getTotal();
        $count =Cart::getContent()->count();

        $carts=json_decode( $carts->toJson(), true );

        return view('site.cart' ,['carts'=>$carts ,'total'=>$total,'count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if($request->ajax()){

            $id= request('id');
            $product=Product::findorfail($id);
            $add=Cart::add([
                'id'=>$id,
                'name'=>$product['name'],
                'price'=>$product['price'],
                'quantity'=>1,
                'attributes' =>array(
                    'describe'=>$product['type'],
                    'image' =>$product['image'],
                )
            ]);


        }

        $count =Cart::getContent()->count();
        session()->forget('count');
        session()->put('count', $count);
        return response(['status'=>true ,'message'=>'Add Produc Succsessfuly' ,'count'=>$count]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id ,Request $request)
    {

        if($request->ajax()){

            $id=request('id');
            $conter=request('conter');
            $carts=Cart::get($id);

            $carts["quantity"]=0;

            Cart::update($id, array(
                'quantity' => $conter,
            ));

        }
        $total=Cart::getTotal();
        $count =Cart::getContent()->count();
        session()->forget('count');
        session()->put('count', $count);
        return response(['status'=>true ,'message'=>'Add Produc Succsessfuly' ,'count'=>$count,'total'=>$total]);    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::Remove($id);
        $count =Cart::getContent()->count();
        session()->forget('count');
        session()->put('count', $count);
        return redirect()->back();
    }
}
