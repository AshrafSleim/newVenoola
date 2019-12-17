<?php

namespace App\Http\Controllers\Employee;

use App\Gategory;
use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;
Use Alert;

class Product extends Controller
{
    public function index(Request $request,$id)
    {
        $categories=Gategory::all();
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $products = $query->where('market_id',$id)->orderBy('id', 'desc')->paginate(10);
            $products->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&category=" . $request->category
            );
        } else {
            $products = \App\Product::query()->where('market_id',$id)->orderBy('id', 'desc')->paginate(10);
        }
        return view('employee.product', compact('products','id','categories'));
    }

    public function returnSearchResult($request)
    {
        $name               = $request->name;
        $category             = $request->category;
        $products              = \App\Product::query();
        $products->where(function ($query) use ($name, $category) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($category) {
                $query->where('category', '=', $category);
            }
            return $query;
        });

        return $products;
    }


    public function delete($id)
    {
        \App\Product::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }


    public function getNew($id){
        $categories=Gategory::all();
        return view('employee.addProduct',compact('id','categories'));
    }
    public function postNew(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'nameAr'=>'required',
            'counter'=>'required  | numeric',
            'price'=>'required  | numeric',
            'image'=>'required',
            'age'=>'required',
            'category'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }else{
            $market= Market::findOrFail($id);
            if ($request->hasFile('image')) {
                $image    = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads"), $new_name);
            } else {
                $new_name = "";
            }
            \App\Product::create([
                'name' =>$request->name,
                'nameAr' =>$request->nameAr,
                'age' =>$request->age,
                'image' =>$new_name,
                'counter' =>$request->counter,
                'price' =>$request->price,
                'category' =>$request->category,
                'vendor_id'=>$market->vendor_id,
                'market_id'=>$id,
            ]);
            Alert::success('Successful Added !');
            return redirect()->back();
        }

    }


    public function getUpdate($id){
        $categories=Gategory::all();
        $product=\App\Product::findOrFail($id);
        return view('employee.updateProduct',compact('product','categories'));
    }
    public function postUpdate(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'nameAr' => 'required',
            'counter' => 'required  | numeric',
            'price' => 'required  | numeric',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads"), $new_name);
                \App\Product::where('id', $id)->update([
                    'name' => $request->name,
                    'age' => $request->age,
                    'nameAr' => $request->nameAr,
                    'image' => $new_name,
                    'counter' => $request->counter,
                    'price' => $request->price,
                    'category' => $request->category,
                ]);
            } else {
                \App\Product::where('id', $id)->update([
                    'name' => $request->name,
                    'age' => $request->age,
                    'nameAr' => $request->nameAr,
                    'counter' => $request->counter,
                    'price' => $request->price,
                    'category' => $request->category,
                ]);
            }
            Alert::success('Successful Update !');
            return redirect()->back();

        }
    }
}
