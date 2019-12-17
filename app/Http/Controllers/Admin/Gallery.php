<?php

namespace App\Http\Controllers\Admin;

use App\GalleryImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;
class Gallery extends Controller
{

    public function index(){
        session()->forget('menu');
        session()->put('menu', 'gallery');
        $galleries=\App\Gallery::query()->paginate(10);
        return view('admin.gallery.index',compact('galleries'));
    }

    public function addNew(Request $request){
        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("uploads"), $new_name);
        } else {
            $new_name = "";
        }

        \App\Gallery::create(
            [
                'name' =>$request->name,
                'main_image' =>$new_name,
            ]);
        return redirect()->back();
    }


    public function delete($id){
        GalleryImage::where('gallery_id',$id)->delete();

        \App\Gallery::findOrFail($id)->delete();
        Alert::success('Successful delete !');

        return redirect()->back();
    }

    public function Update(Request $request,$id){
        \App\Gallery::findOrFail($id);
        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("uploads"), $new_name);
            \App\Gallery::where('id', $id)->update(
                [
                    'name' =>$request->name,
                    'main_image' =>$new_name,
                ]);
        } else {
            \App\Gallery::where('id', $id)->update(
                [
                    'name' =>$request->name,
                ]);
        }
        return redirect()->back();
    }


    public function getAllImage($id){
        $gallery = \App\Gallery::findOrFail($id);
        $images=GalleryImage::where('gallery_id',$id)->paginate(10);
        return view('admin.gallery.allImage',compact('images','id'));
    }

    public function deleteImage($id){
        GalleryImage::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function addNewImages(Request $request,$id){
        $gallery = \App\Gallery::findOrFail($id);

        $imges=$request->imges;
        if (count($imges)>0){
            foreach ($imges as $imge){
                $new_name = rand() . '.' . $imge->getClientOriginalExtension();
                $imge->move(public_path("uploads"), $new_name);
                GalleryImage::create([
                    'gallery_id'=>$id,
                    'name'=>$new_name,
                ]);
            }
        }
        Alert::success('Successful Store !');

        return redirect()->back();
    }


}
