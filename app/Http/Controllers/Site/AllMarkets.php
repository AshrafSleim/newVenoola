<?php

namespace App\Http\Controllers\Site;

use App\Gategory;
use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AllMarkets extends Controller
{
    public function index(){
      $markets=  Market::where('active','active')->paginate(10);
        return view('site.products-shope',compact('markets'));
    }



    public function allProduct(Request $request,$id){
        $categories=Gategory::all();
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $products = $query->where('market_id',$id)->where('active','active')->orderBy('id', 'desc')->paginate(10);
            $products->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&category=" . $request->category .
                "&priceFrom=" . $request->priceFrom .
                "&priceTo=" . $request->priceTo .
                "&age=" . $request->age
            );
        } else {
            $products = \App\Product::query()->where('market_id',$id)->where('active','active')->orderBy('id', 'desc')->paginate(10);
        }

        return view('site.products-market',compact('products','categories','id'));
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



}
