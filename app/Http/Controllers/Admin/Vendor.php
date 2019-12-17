<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
class Vendor extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'vendor');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $users = $query->orderBy('id', 'desc')->paginate(10);
            $users->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&email=" . $request->email .
                "&mobile=" . $request->mobile
            );
        } else {
            $users = \App\Vendor::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.vendors', compact('users'));
    }

    public function returnSearchResult($request)
    {
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $users = \App\Vendor::query();
        $users->where(function ($query) use ($name, $email, $mobile) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($email) {
                $query->where('email', 'LIKE', ['%' . $email . '%']);
            }
            if ($mobile) {
                $query->where('phone', 'LIKE', ['%' . $mobile . '%']);
            }
            return $query;
        });

        return $users;
    }


    public function delete($id)
    {
        \App\Vendor::findOrFail($id)->delete();
        \App\Product::where('vendor_id',$id)->delete();
        \App\Market::where('vendor_id',$id)->delete();

        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function showMarkets($id)
    {
        $markets = Market::where('vendor_id', $id)->paginate(10);
        return view('admin.vendorMarkets', compact('markets'));
    }

    public function deleteMarket($id)
    {
        Market::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();

    }
}
