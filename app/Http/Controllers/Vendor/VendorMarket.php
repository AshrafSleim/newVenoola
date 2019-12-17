<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;
use Alert;
use Validator;

class VendorMarket extends Controller
{
    public function index($id){
        session()->forget('menu');
        session()->put('menu', 'markets');
        $markets= Market::where('vendor_id',$id)->paginate(10);
        return view('userVendor.markets',compact('markets','id'));
    }
    public function delete($id)
    {
        Market::findOrFail($id)->delete();
        \App\Product::where('market_id',$id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }
    public function postUpdate(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'phone'=>'required  | numeric | digits_between:8,15',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }else{
            if ($request->hasFile('image')) {
                $image    = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads"), $new_name);
                Market::where('id', $id)->update([
                    'name' =>$request->name,
                    'image' =>$new_name,
                    'phone' =>$request->phone,
                ]);
            } else {
                Market::where('id', $id)->update([
                    'name' =>$request->name,
                    'phone' =>$request->phone,
                ]);
            }
            Alert::success('Successful Update !');
            return redirect()->back();
        }
    }
    public function postNew(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'phone'=>'required  | numeric | digits_between:8,15',
            'image'=>'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }else{
            if ($request->hasFile('image')) {
                $image    = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads"), $new_name);
            } else {
                $new_name = "";
            }
                Market::create([
                    'name' =>$request->name,
                    'image' =>$new_name,
                    'phone' =>$request->phone,
                    'vendor_id'=>$id,
            ]);
            Alert::success('Successful Added !');
            return redirect()->back();
        }
    }
}
