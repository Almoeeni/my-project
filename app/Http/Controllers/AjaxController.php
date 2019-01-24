<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AjaxCrud;
class AjaxController extends Controller
{
    public function index()
    {
        $data = AjaxCrud::orderBy('id', 'DESC')->paginate(5);
        return view('ajaxform.form', compact('data'));
    }

    public function create(){
        return 123;
    }

    public function store(Request $request)
    {
      
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
        ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()]); 
    
      }
      else{
     
        $input = AjaxCrud::create($request->all()); 
        $input->save();
        return response()->json(['success'=>'Added new records.']);
      }
       
  
       
             
       
      //  return redirect()->back();
    }
    public function edit($id)
    {
        //
    }

    public function update(Request $request , $link_id)
    {
    //         $validator = \Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email|max:255|unique:users',
    //         // 'password' => 'required|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
    //     ]);

    //   if($validator->fails()){
    //     return response()->json(['error'=>$validator->errors()]); 
    
    //   }
    //   else{
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
        ]);

        if($validator->fails())

     
        $input = AjaxCrud::findOrFail($link_id);
        
        $input->name = $request->name;
        $input->email = $request->email;
        $input->save();
        //return response()->json($input);
        return response()->json(['success'=>'Added new records.']);    
      //}
    }
}