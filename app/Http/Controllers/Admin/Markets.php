<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
class Markets extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'markets');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $markets = $query->orderBy('id', 'desc')->paginate(10);
            $markets->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name
            );
        } else {
            $markets = Market::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.allMarkets', compact('markets'));
    }

    public function returnSearchResult($request)
    {
        $name = $request->name;
        $markets = Market::query();
        $markets->where(function ($query) use ($name) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }

            return $query;
        });

        return $markets;
    }


    public function delete($id)
    {
        Market::findOrFail($id)->delete();
        \App\Product::where('market_id',$id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }
    public function updateStatus(Request $request, $id){

        Market::findOrFail($id)->update(['active' => $request->active]);

        Alert::success('Successful Updated !');

        return redirect()->back();

    }
}
