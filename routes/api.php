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
Route::get('/catatan', 'CatatanController@index');
Route::get('/catatan/{id}', 'CatatanController@show');
Route::post('/catatan', 'CatatanController@store');
Route::delete('/catatan/{id}', 'CatatanController@destroy');
Route::patch('/catatan/{id}', 'CatatanController@update');

Route::get('/jadwal', 'JadwalController@index');
Route::get('/jadwal/{id}', 'JadwalController@show');
Route::post('/jadwal', 'JadwalController@store');
Route::delete('/jadwal/{id}', 'JadwalController@destroy');
Route::patch('/jadwal/{id}', 'JadwalController@update');

Route::get('/arsip', 'ArsipController@index');
Route::get('/arsip/{id}', 'ArsipController@show');
Route::post('/arsip', 'ArsipController@store');
Route::delete('/arsip/{id}', 'ArsipController@destroy');
Route::patch('/arsip/{id}', 'ArsipController@update');

Route::get('/userdetail', 'UsersDetailController@index');
Route::post('/userdetail', 'UsersDetailController@store');
Route::patch('/userdetail/{id}', 'UsersDetailController@update');

Route::get('/user', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::post('/user/register', 'UserController@register');
Route::post('/user/login', 'UserController@login');
Route::delete('/user/{id}', 'UserController@destroy');
Route::patch('/user/name/{id}', 'UserController@update');
Route::patch('/user/password/{id}', 'UserController@updatePassword');

Route::post('/mail/send', 'MailController@send');
Route::get('/user/verfikasi/{token}', 'UserController@verifikasi');