<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AjaxCrud;
class AjaxController extends Controller
{
    public function index()
    {
        return view('ajaxform.form');
    }

    public function create(){
        return 123;
    }

    public function store(Request $request)
    {
        // $input =$request->all();
        // dd($input);

        //$this->validate($request,[
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
        ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()]);
        // return response()->json(array(
        //     'success' => false,
        //     'errors' => $validator->errors()->all()
    
        // ));
  
    
      }
      else{
     
        $input = AjaxCrud::create($request->all()); 
        $input->save();
        return response()->json(['success'=>'Added new records.']);
      }
       
  
       
             
       
      //  return redirect()->back();
    }
}