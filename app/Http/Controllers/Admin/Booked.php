<?php

namespace App\Http\Controllers\Admin;

use App\Booktrip;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
class Booked extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'book');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $books = $query->orderBy('id', 'desc')->paginate(10);
            $books->setPath(URL::current() . "?" . "filter=1" .
                "&code=" . $request->code .
                "&name=" . $request->name .
                "&mobile=" . $request->mobile
            );
        } else {
            $books = Order::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.booking', compact('books'));
    }


    public function updateStatus(Request $request,$id){
        Order::findOrFail($id)->update(['pay' => $request->pay]);

        return redirect()->back();
    }

    public function show($id){
    $book=Order::findOrFail($id);
        $products=OrderProduct::where('order_id',$id)->paginate(10);
        return view('admin.bookShow',compact('book','products'));
    }



    public function print($id){
        $book=Order::findOrFail($id);
        $products=OrderProduct::where('order_id',$id)->get();
        return view('admin.printBook',compact('book','products'));
    }


    public function returnSearchResult($request)
    {
        $code               = $request->code;
        $name              = $request->name;
        $mobile             = $request->mobile;
        $books              = Order::query();
        $books->where(function ($query) use ($code, $name, $mobile) {
            if ($code) {
                $query->where('code', '=', $code );
            }
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($mobile) {
                $query->where('phone', 'LIKE', ['%' . $mobile . '%']);
            }
            return $query;
        });

        return $books;
    }


    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }
}
