<?php
use App\AjaxCrud;
use App\Sorting;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/layouts', function () {
    return view('layouts.master');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ListingsController@index');
Route::resource('listing', 'ListingsController');


//Album routes
// Route::get('/album', 'AlbumsController@index');
// Route::get('/album/create', 'AlbumsController@create');
// Route::post('/album/store/', 'AlbumsController@store');

Route::resource('/album','AlbumsController');

//photos routes
Route::get('/photo/create/{id}','PhotosController@create');
Route::post('/photo/store/','PhotosController@store');
Route::get('/photo/{id}','PhotosController@show');
Route::Delete('/photo/{id}','PhotosController@destroy');


// form route
route::delete('forms/{id}/destroy','FormController@destroy');
route::post('forms/{id}/update', 'FormController@update');
route::get('forms/{id}/edit', 'FormController@edit');
route::post('forms/store', 'FormController@store');
Route::resource('forms','FormController');

//notification checkbox

route::get('notification','NotificationController@index');
route::post('notification','NotificationController@store');


route::post('/listing/{listing}/comment', "CommentsController@store");



Route::get('/links/{link_id?}', function ($link_id) {
    $link = AjaxCrud::find($link_id);
    return Response::json($link);
});

route::post('/ajaxupdate/{link_id?}' , 'AjaxController@update');
route::post('/ajaxform' , 'AjaxController@store');
route::resource('ajax' , 'AjaxController');

// sorting darg drop jquery ui
route::get('/sorting' , 'SortingController@index');
 //route::get('/sorting/menu' , 'SortingController@menu');
 Route::get('/drag',function(){
	$menu = Sorting::orderBy('sorting','ASC')->get();
	return view('jquery.drag', compact('menu'));
});
//  Route::get('order-menu', function () {
//      $menu = Sorting::OrderBy('sorting','ASC')->get();
//      $itemID = input::get('itemID');
//      $itemIndex = input::get('itemIndex');  

//         foreach($menu as $value){
//             return Sorting::where('id' ,'=',$itemID)->update(array('sorting' => $itemIndex));
//         }
//   //  return view('jquery.drag');
// });

route::get('order-menu', 'SortingController@update');