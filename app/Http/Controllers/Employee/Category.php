<?php

namespace App\Http\Controllers\Employee;

use App\Gategory;
use App\Http\Controllers\Controller;
use App\Market;
use App\VendorEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;

class Category extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'category');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $categories = $query->orderBy('id', 'desc')->paginate(10);
            $categories->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name
            );
        } else {
            $categories = Gategory::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('employee.gategory', compact('categories'));
    }

    public function returnSearchResult($request)
    {
        $name = $request->name;
        $categories = Gategory::query();
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
        Gategory::findOrFail($id)->delete();
        \App\Product::where('category',$id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function addNew(Request $request)
    {
        $user = VendorEmployee::find(auth()->guard('employee')->user()->id);
        if ($user->addCategory == "yes") {
            Gategory::create(
                [
                    'name' => $request->name,
                    'nameAr' => $request->nameAr,
                ]);
            Alert::success('Successful saved !');
            return redirect()->back();
        }else{
            Alert::error('You not have permission !');
            return redirect()->back();
        }
    }

}
