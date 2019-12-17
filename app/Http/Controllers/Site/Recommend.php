<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Event;
use App\Gategory;
use App\Http\Controllers\Controller;
use App\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Recommend extends Controller
{
    public function index(){
        $categories=Gategory::all();
        $relations=Relation::all();
        $brands=Brand::all();
        $events=Event::all();
        return view('site.recommend',compact('categories','relations','brands','events'));
    }


    public function allProduct(Request $request){
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $products = $query->orderBy('id', 'desc')->paginate(10);
            $products->setPath(URL::current() . "?" . "filter=1" .
                "&relation=" . $request->relation .
                "&age=" . $request->age .
                "&type=" . $request->type .
                "&event=" . $request->event .
                "&brand=" . $request->brand .
                "&price=" . $request->price
            );
        } else {
            $products = \App\Product::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('site.products2',compact('products'));
    }





    public function returnSearchResult($request)
    {

        $relation         = $request->relation;
        $age             = $request->age;
        $type             = $request->type;
        $event           = $request->event;
        $brand           = $request->brand;
        $price          = $request->price;
        $products              = \App\Product::query();
        $products->where(function ($query) use ($relation, $type,$age,$event,$brand,$price) {
            if ($event) {
                $query->where('event_id', '=', $event);
            }
            if ($relation) {
                $query->where('relation_id', '=', $relation);
            }
            if ($brand) {
                $query->where('brand_id', '=', $brand);
            }
            if ($type) {
                $query->where('type', '=', $type);
            }
            if ($age) {
                $query->where('age', '=', $age);
            }
            if ($price) {
                $query->where('price', '=', $price);
            }
            return $query;
        });

        return $products;
    }




}
