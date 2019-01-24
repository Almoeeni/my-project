<?php

namespace App\Http\Controllers;
use App\Sorting;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class SortingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sort = Sorting::OrderBy('sorting','ASC')->get();
        $menu = Menu::all();
        return view('jquery.sort',compact('sort','menu'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      //   dd($request->all());

         $menu = Sorting::all();
         foreach($menu as $menus)
         {
            $id= $menus->id;
          //  $menus->timestamps = false;
            foreach($request->order as $orders)
            {
                //dd($id);
                if($orders['id'] == $id)
                {
                 // dd($orders['position']);

               $menus->update(['sorting' => $orders['position']]);
                }
            }
         }
        // $itemID =  $request->itemID;         
        // $itemIndex = $request->itemIndex;                   
   
        //    foreach($menu as $value){
        //             dd($value);
        //     Sorting::where('id', '=', $itemID)->update([
        //             'sorting' => $itemIndex
        //      ]);
        //    }
        //    return response('Update Successfully.', 200);


        return response('Update Successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
