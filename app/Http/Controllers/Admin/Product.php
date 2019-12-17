<?php

namespace App\Http\Controllers\Admin;

use App\Gategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
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
        return view('admin.product', compact('products','id','categories'));
    }

    public function returnSearchResult($request)
    {
        $name               = $request->name;
        $category             = $request->category;
        $users              = \App\Product::query();
        $users->where(function ($query) use ($name, $category) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($category) {
                $query->where('category', '=', $category);
            }
            return $query;
        });

        return $users;
    }


    public function delete($id)
    {
        \App\Product::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

}
