<?php

namespace App\Http\Controllers\Site;

use App\Gategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Product extends Controller
{
    public function siteIndex(){
        $count=\App\Product::orderBy('id', 'desc')->count();
        if ($count >5) {
            $products = \App\Product::orderBy('id', 'desc')->take(5)->get();
        }else{
            $products = \App\Product::orderBy('id', 'desc')->take($count)->get();
        }
        return view('site.index',compact('products'));
    }


    public function allProduct(Request $request){
        $categories=Gategory::all();
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $products = $query->orderBy('id', 'desc')->paginate(10);
            $products->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&category=" . $request->category .
                "&priceFrom=" . $request->priceFrom .
                "&priceTo=" . $request->priceTo .
                "&age=" . $request->age
            );
        } else {
            $products = \App\Product::query()->orderBy('id', 'desc')->paginate(10);
        }

        return view('site.products',compact('products','categories'));
    }

    public function returnSearchResult($request)
    {
        $name               = $request->name;
        $category             = $request->category;
        $priceFrom             = $request->priceFrom;
        $priceTo            = $request->priceTo;
        $age           = $request->age;
        $products              = \App\Product::query();
        $products->where(function ($query) use ($name, $category,$age,$priceFrom,$priceTo) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($category) {
                $query->where('category', '=', $category);
            }
            if ($age) {
                $query->where('age', '=', $age);
            }
            if ($priceFrom) {
                $query->whereBetween('price', array($priceFrom, $priceTo));

//                $query->whereBetween('price',[$priceFrom, $priceTo]);
            }
            return $query;
        });

        return $products;
    }



    public function productInfo($id){
        $product =\App\Product::findOrFail($id);
        return view('site.product-detail',compact('product'));
    }

}
