<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
class AlbumsController extends Controller
{
    public function index(){

        $album = Album::all();

        return view('album.index')->with('album', $album);
    }

    public function create(){
        return view('album.create');
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'cover_image' => 'image|max:1999',

        ]);

        //Get the file with extension
        $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();

        //Get the file name 
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        //get the extension
        $fileExtension = $request->file('cover_image')->getClientOriginalExtension();

        //file name store with time
        $filestore = $fileName .'_'.time().'.'.$fileExtension;

        // upload the image
            $path = $request->file('cover_image')->storeAs('public/album_covers', $filestore);
            


            // Create  the album
            $album = new Album;
            $album->name = $request -> input('name');
            $album->description = $request-> input('description');
            $album->cover_image =$filestore;
            $album->user_id = auth()->user()->id;

            $album->save();

            return redirect('/album')->with('success','album created folks');
    }


    public function show($id){
        // $album = Album::find($id);
               $album = Album::with('photos')->findOrFail($id);

        return view('album.show')->with('album', $album);
    }



}
