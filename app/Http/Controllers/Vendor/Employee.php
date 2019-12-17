<?php

namespace App\Http\Controllers\Vendor;

use App\EmployeeMarket;
use App\Http\Controllers\Controller;
use App\Market;
use App\VendorEmployee;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;
use Validator;

class Employee extends Controller
{
    public function index($id){
        session()->forget('menu');
        session()->put('menu', 'employees');
        $employees=VendorEmployee::where('vendor_id',$id)->paginate(10);
        return view('userVendor.allEmployees',compact('employees'));
    }

    public function getNew(){
       $markets=Market::where('vendor_id',auth()->guard('vendor')->user()->id)->get();
        return view('userVendor.addemployee',compact('markets'));
    }
    public function postNew(Request $request){
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required |email|max:255',
            'phone' => 'required |numeric |digits_between:8,15',
            'password' => 'required  | min:6',
            'market' => 'required',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
//            'name','phone','email','addMarket','addCategory','vedor_id',


            $employee=VendorEmployee::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'phone' =>$request->phone,
                'password' =>Hash::make($request->password),
                'addMarket' =>$request->market,
                'addCategory'=>$request->category,
                'vendor_id'=>auth()->guard('vendor')->user()->id,

            ]);
            if ($request->has('markets')){
                foreach ($request->markets as $market){
                    EmployeeMarket::create([
                        'employee_id'=>$employee->id,
                        'market_id'=>$market,

                    ]);
                }
            }
            Alert::success('Successful Added !');
            return redirect()->back();

        }
    }

    public function getUpdate($id){
        $employee=VendorEmployee::findOrFail($id);
        $markets=Market::where('vendor_id',auth()->guard('vendor')->user()->id)->get();
        $allEmployeeMarket=EmployeeMarket::where('employee_id',$id)->select('market_id')->get();
        $employeeMarket=[];
       foreach ($allEmployeeMarket as $market){
           array_push($employeeMarket,$market->market_id);
       }
        return view('userVendor.updateEmployee',compact('markets','employeeMarket','employee'));
    }

    public function postUpdate(Request $request,$id)
    {
        VendorEmployee::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required |email|max:255',
            'phone' => 'required |numeric |digits_between:8,15',
            'market' => 'required',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {


            $employee = VendorEmployee::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'addMarket' => $request->market,
                'addCategory' => $request->category,
                'vendor_id' => auth()->guard('vendor')->user()->id,

            ]);
            if ($request->has('markets')) {
                EmployeeMarket::where('employee_id',$id)->delete();
                foreach ($request->markets as $market) {
                    EmployeeMarket::create([
                        'employee_id' => $id,
                        'market_id' => $market,

                    ]);
                }
            }else{
                EmployeeMarket::where('employee_id',$id)->delete();

            }
            Alert::success('Successful Updated !');
            return redirect()->back();


        }
    }

    public function delete($id){
        EmployeeMarket::where('employee_id',$id)->delete();
        VendorEmployee::where('id',$id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

}
