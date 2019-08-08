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

Route::post('login', 'LoginController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('menu', 'Home@getMenu');
    Route::post('actions', 'Home@getPermisos');

    Route::post('empleado', 'Empleado@create');
    Route::post('empleado/update', 'Empleado@update');
    Route::get('empleado/search', 'Empleado@searchAll');
});

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
