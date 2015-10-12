<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');
});


//Route::get('/classrooms', function () {
//    return view('admin.classrooms.index');
//});


//Put under Middleware
Route::group(['prefix' => 'admin'], function(){
    Route::resource('/classrooms','Classrooms');
    Route::resource('/tables','TablesController');
    Route::resource('/seats', 'SeatsController');
    Route::get('/tables/{tableId}/seats', 'TablesController@seats');
});

Route::group(['prefix' => 'api'], function (){
    Route::resource('/classrooms','Json\ClassroomController');
    Route::resource('/tables','Json\TablesController');
    Route::resource('/seats','Json\SeatsController');
});


