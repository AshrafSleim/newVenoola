<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
class Promo extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'promo');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $promos = $query->orderBy('id', 'desc')->paginate(10);
            $promos->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name
            );
        } else {
            $promos= PromoCode::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.promo', compact('promos'));
    }

    public function returnSearchResult($request)
    {
        $name = $request->name;
        $promos = PromoCode::query();
        $promos->where(function ($query) use ($name) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }

            return $query;
        });

        return $promos;
    }


    public function delete($id)
    {
        PromoCode::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function addNew(Request $request){
        PromoCode::create([
            'name'=>$request->name,
            'discount'=>$request->discount,
            'endpromo'=>$request->endpromo,

        ]);
          Alert::success('Successful Added !');
        return redirect()->back();
    }

}
