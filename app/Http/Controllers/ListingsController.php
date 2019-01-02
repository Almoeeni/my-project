<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Listing;
class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
         $this->middleware('auth',['except' => ['index','show']]);
     }




    public function index()
    {
        $listing = Listing::OrderBy('created_at', 'desc')->paginate(4);
       return view('dashboard')->with('listing',$listing);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'company' => 'required',
            'website' => 'required',

        ]);

        // Submiting Form 
        $listing = new Listing;
        $listing->company = $request->input('company');
        $listing->website = $request->input('website');
        $listing->email = $request->input('email');
        $listing->bio = $request->input('bio');
        $listing->user_id = auth()->user()->id;

        $listing->save();

        return redirect('/home')->with('success' ,'Data submited');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $listing = Listing::findOrFail($id);
        $comments = $listing->comment()->orderBy('id','desc')->paginate(5);
      return view('showlisting',compact('listing','comments'));
        //->with('listing',$listings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        return view('update')->with('listing', $listing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'company' => 'required',
            'website' => 'required',

        ]);

        // Submiting Form 
        $listing = Listing::find($id);
        $listing->company = $request->input('company');
        $listing->website = $request->input('website');
        $listing->email = $request->input('email');
        $listing->bio = $request->input('bio');
        $listing->user_id = auth()->user()->id;

        $listing->save();

        return redirect('/home')->with('success' ,'Data Edit submited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listings = Listing::findOrFail($id);
        $listings->delete();
        return redirect('/home')->with('success','Data is deleted');
    }




}
