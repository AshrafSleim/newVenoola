<?php

namespace App\Http\Controllers\Admin;

use App\Gategory;
use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;
Use Alert;

class AllProduct extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'allProduct');
        $categories=Gategory::all();
        $events=\App\Event::all();
        $relations=\App\Relation::all();
        $markets=Market::all();
        $brands=\App\Brand::all();
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $products = $query->orderBy('id', 'desc')->paginate(10);
            $products->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&event=" . $request->event .
                "&relation=" . $request->relation .
                "&brand=" . $request->brand .
                "&market=" . $request->market .
                "&status=" . $request->status .
                "&category=" . $request->category
            );
        } else {
            $products = \App\Product::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.allProduct', compact('products','categories','events','relations','markets','brands'));
    }

    public function returnSearchResult($request)
    {
        $name               = $request->name;
        $event             = $request->event;
        $relation             = $request->relation;
        $market             = $request->market;
        $status             = $request->status;
        $brand             = $request->brand;
        $category             = $request->category;
        $products              = \App\Product::query();
        $products->where(function ($query) use ($name, $event,$relation,$market,$status,$brand,$category) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($event) {
                $query->where('event_id', '=', $event);
            }
            if ($relation) {
                $query->where('relation_id', '=', $relation);
            }
            if ($market) {
                $query->where('market_id', '=', $market);
            }
            if ($status) {
                $query->where('active', '=', $status);
            }
            if ($brand) {
                $query->where('brand_id', '=', $brand);
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

    public function getUpdate($id){
        $categories=Gategory::all();
        $events=\App\Event::all();
        $relations=\App\Relation::all();
        $brands=\App\Brand::all();
        $product=\App\Product::findOrFail($id);
        return view('admin.updateProduct',compact('product','categories','events','relations','brands'));
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

                    'type' => $request->type,
                    'brand_id' => $request->brand,
                    'relation_id' => $request->relation,
                    'event_id' => $request->event,
                    'active' => $request->status,

                ]);
            } else {
                \App\Product::where('id', $id)->update([
                    'name' => $request->name,
                    'age' => $request->age,
                    'nameAr' => $request->nameAr,
                    'counter' => $request->counter,
                    'price' => $request->price,
                    'category' => $request->category,


                    'type' => $request->type,
                    'brand_id' => $request->brand,
                    'relation_id' => $request->relation,
                    'event_id' => $request->event,
                    'active' => $request->status,
                ]);
            }
            Alert::success('Successful Update !');
            return redirect()->back();

        }
    }

}
