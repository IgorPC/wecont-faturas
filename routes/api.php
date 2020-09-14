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

Route::post('/login', 'AutenticateController@login');

Route::get('/generate-adm-user', 'UserController@generateAdmUser');

Route::group(['middleware' => ['jwt']], function (){
    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@create');
    Route::delete('/user/{id}', 'UserController@remove');
    Route::put('/user/{id}', 'UserController@update');

    Route::get('/bill', 'BillController@index');
    Route::post('/bill', 'BillController@create');
    Route::put('/bill/{id}', 'BillController@update');
    Route::get('/bill/{id}', 'BillController@show');
    Route::delete('/bill/{id}', 'BillController@remove');
    Route::put('/approve-payment/{id}', 'BillController@approvePayment');
});
