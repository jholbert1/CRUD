<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Estudiantes
Route::group([
    'prefix' => 'student'
], function () {
    Route::get('show', 'StudentController@index');
    Route::post('register', 'StudentController@store');
    Route::put('update/{id}', 'StudentController@update');
    Route::delete('delete/{id}', 'StudentController@destroy');
});

//Carreras
Route::group([
    'prefix' => 'career'
], function () {
    Route::get('show', 'CareerController@index');
    Route::post('register', 'CareerController@store');
    Route::put('update/{id}', 'CareerController@update');
    Route::delete('delete/{id}', 'CareerController@destroy');
});

//Paises
Route::group([
    'prefix' => 'career'
], function () {
    Route::get('index', 'CountriesController@index');
    Route::get('show/{id}', 'CountriesController@show');
});

