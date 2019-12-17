<?php

namespace App\Http\Controllers\Admin;

use App\Description;
use App\Http\Controllers\Controller;
use App\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;

class Package extends Controller
{
    public function index(Request $request, $id){
        $tour = Tour::findOrFail($id);

        if ($request->filter == 1) {
            $query  = $this->returnSearchResult($request);
            $packages = $query->where('tour_id',$id)->orderBy('id', 'desc')->paginate(10);
            $packages->setPath(URL::current() . "?"
                . "filter=1"
                . "&name=" . $request->name
                . "&salary=" . $request->salary
                . "&from=" . $request->from
                . "&to=" . $request->to
                . "&type=" . $request->type);
            $type=$request->type;
        } else {
            $type='';
            $packages = \App\Package::query()->where('tour_id',$id)->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.packages.index',compact('packages','type','id'));
    }

    public function getNew($tourId){
        return view('admin.packages.newPackage',compact('tourId'));
    }
    public function postNew(Request $request,$tour_id){

        $requestData = $request->all();
        $requestData['from']= Carbon::createFromFormat('d/m/Y', $request->from);
        $requestData['to']=Carbon::createFromFormat('d/m/Y', $request->to);
        $validator = Validator::make($requestData, [
            'name'=>'required',
            'type'=>'required',
            'from'=>'required | after:yesterday',
            'to'=>'required |after_or_equal:from',
            'salary'=>'required',
            'mainImage'=>'image| mimes:jpeg,png,jpg',
            'mainDescription'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }
        else {
            if ($request->hasFile('mainImage')) {
                $image    = $request->file('mainImage');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads"), $new_name);
            } else {
                $new_name = "";
            }
            $row=\App\Package::create(
                [
                    'tour_id'=>$tour_id,
                    'name' =>$requestData['name'],
                    'salary' =>$requestData['salary'],
                    'image' =>$new_name,
                    'description' =>$requestData['mainDescription'],
                    'type' =>$requestData['type'],
                    'from' =>$requestData['from'],
                    'to' =>$requestData['to'],
                ]);
            return redirect(route('allPackage',$tour_id));
        }
    }

    public function getupdate($id)
    {
        $package = \App\Package::findOrFail($id);
        $package->from=date("d/m/Y", strtotime($package->from));
        $package->to=date("d/m/Y", strtotime($package->to));
        return view('admin.packages.update', compact('package'));
    }
    public function update(Request $request,$id){
        $requestData = $request->all();
        $requestData['from']= Carbon::createFromFormat('d/m/Y', $request->from);
        $requestData['to']=Carbon::createFromFormat('d/m/Y', $request->to);
        $validator = Validator::make($requestData, [
            'name'=>'required',
            'type'=>'required',
            'from'=>'required | after:yesterday',
            'to'=>'required |after_or_equal:from',
            'salary'=>'required',
            'mainDescription'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }else {
            if ($request->hasFile('mainImage')) {
                $image    = $request->file('mainImage');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads"), $new_name);
                \App\Package::where('id', $id)->update([
                    'name' =>$requestData['name'],
                    'salary' =>$requestData['salary'],
                    'image' =>$new_name,
                    'description' =>$requestData['mainDescription'],
                    'type' =>$requestData['type'],
                    'from' =>$requestData['from'],
                    'to' =>$requestData['to'],
                ]);
            } else {
                \App\Package::where('id', $id)->update([
                    'name' =>$requestData['name'],
                    'salary' =>$requestData['salary'],
                    'description' =>$requestData['mainDescription'],
                    'type' =>$requestData['type'],
                    'from' =>$requestData['from'],
                    'to' =>$requestData['to'],
                ]);
            }
            $tour_id = \App\Package::findOrFail($id);
            return redirect(route('allPackage',$tour_id->tour_id));
        }

    }

    public function delete($id){
        \App\Package::findOrFail($id)->delete();
//        Alert::success('Successful delete !');
        return redirect()->back();
    }


    public function returnSearchResult($request)
    {
        $name   = $request->name;
        $salary      = $request->salary;
        $from    = $request->from;
        $to      = $request->to;
        $type = $request->type;
        $packages  = \App\Package::query();
        $packages->where(function ($query) use ($name, $from, $salary, $to, $type) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($from) {
                $query->where('from', '=',  $from);
            }
            if ($type) {
                $query->where('type', '=', $type);
            }
            if ($to) {
                $query->where('to', '=', $to);
            }
            if ($salary) {
                $query->where('salary', '=', $salary);
            }
            return $query;
        });
        return $packages;
    }

}
