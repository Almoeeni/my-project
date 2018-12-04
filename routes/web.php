<?php

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

Route::get('/', function () {
    return view('welcome');
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