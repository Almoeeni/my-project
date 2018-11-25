<?php

namespace App\Http\Controllers;
use App\Photo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;
class PhotosController extends Controller
{
   public function create($album_id){
     
       return view('photo.create')->with('album_id' ,$album_id);
   }

   public function store(Request $request){
       $this->validate($request,[
        'title' => 'required',
        'photo' => 'required|image|max:1999',
       ]);

       // Get the full name of photo
       $filenamewithext = $request->file('photo')->getClientOriginalName();
       
       //get only name
       $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

       //get Extension
        $fileExt = $request->file('photo')->getClientOriginalExtension();

        //file name store technique
        $filenamestore = $filename .'_'.time().'_'.$fileExt;

        $path = $request->file('photo')->StoreAs('/public/photos'.$request->input('album_id'),$filenamestore);
       
        //create photo into album
        $photo = new Photo;

        $photo->album_id = $request->input('album_id');
        $photo->photo = $filenamestore;
        $photo->title= $request->input('title');
        $photo->description = $request -> input('description');
        $photo->size= $request->file('photo') ->getClientSize();

        $photo ->save();

        return redirect('album/'.$request->input('album_id'))->with('success','Photo has been uploaded');


       
   }

   public function show($id){
       $photo = Photo::findOrFail($id);
       return view('photo.show')->with('photo',$photo);
   }

   public function destroy($id){
     
    

    if(storage::delete('public/photos'.$photo->album_id.'/'.$photo->photo)){
        $photo->delete();
        return  redirect('/album')->with('success','photo deleted');
    }

   }

}
