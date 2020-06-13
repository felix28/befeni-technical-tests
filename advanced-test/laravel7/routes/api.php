<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('shirt-orders', 'ShirtOrderController@index');
Route::post('shirt-orders', 'ShirtOrderController@store');
Route::get('shirt-orders/{id}', 'ShirtOrderController@show');
Route::delete('shirt-orders/{id}', 'ShirtOrderController@destroy');
