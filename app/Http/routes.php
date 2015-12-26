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

    return redirect('/auth/login');

});


//Route::get('/classrooms', function () {
//    return view('admin.classrooms.index');
//});



//Put under Middleware
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::resource('/classrooms','Classrooms');

    Route::resource('/tables','TablesController');

    Route::resource('/seats', 'SeatsController');

    Route::resource('/marks', 'MarksController');

    Route::get('/tables/{tableId}/allSeats', 'TablesController@seats');

    Route::resource('/tables/{tableId}/seats', 'SeatsController');

    // Route::post('/tables/{tableId}/seats/create', ['uses' => 'SeatsController@store'])

    Route::resource('classrooms/{classroomId}/students', 'StudentsController');

    Route::get('assign/{classroomId}', 'Classrooms@assignSeatingChart');

    Route::get('reports', ['uses' => 'ReportsController@index']);

    Route::get('reports/{classroom}', ['uses' => 'ReportsController@selectRange']);

    Route::post('reports/{classroom}', ['uses' => 'ReportsController@query']);
    Route::get('reports/{classroom}/query', ['uses' => 'ReportsController@query']);

    //Get Assigned Students
    Route::get('/classrooms/{classroomId}/unassigned','StudentsController@unassigned')->name('unassignedStudents');
});

Route::group(['prefix' => 'api'], function (){
    Route::resource('/classrooms','Json\ClassroomController');

    Route::resource('/tables','Json\TablesController');

    Route::resource('/seats','Json\SeatsController');

    Route::resource('/marks', 'Json\MarksController');

    Route::get('/assign/{classroomId}','Json\ClassroomController@assign');

    Route::post('students/{id}/marks/{markId}/add', 'Json\MarkStudentsController@addMark')->name('addMark');

    Route::put('students/{id}/marks/{markId}/remove', 'Json\MarkStudentsController@removeMark')->name('removeMark');

    Route::get('students/{id}/marks/today', 'Json\StudentsController@marksToday')->name('marksToday');

    Route::get('/classrooms/{classroomId}/students','Json\ClassroomController@students');

    Route::get('/classrooms/{classroomId}/students/all','Json\StudentsController@index');

    Route::get('/classrooms/{classroomId}/unassigned','StudentsController@unassigned')->name('unassignedStudents');

    Route::post('/seats/{seatId}/students', 'Json\SeatsController@assignStudent');

    Route::put('/seats/{seatId}/students', 'Json\SeatsController@detachStudent');

});



//Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');

//Registration Routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');




