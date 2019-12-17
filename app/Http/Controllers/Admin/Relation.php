<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;

class Relation extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'relation');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $categories = $query->orderBy('id', 'desc')->paginate(10);
            $categories->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name
            );
        } else {
            $categories = \App\Relation::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.relation', compact('categories'));
    }

    public function returnSearchResult($request)
    {
        $name = $request->name;
        $categories = \App\Relation::query();
        $categories->where(function ($query) use ($name) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }

            return $query;
        });

        return $categories;
    }


    public function delete($id)
    {
        \App\Relation::findOrFail($id)->delete();
//        \App\Product::where('category',$id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function addNew(Request $request){
        \App\Relation::create(
            [
                'name' =>$request->name,
                'nameAr' =>$request->nameAr,
            ]);
        Alert::success('Successful saved !');
        return redirect()->back();
    }

}
