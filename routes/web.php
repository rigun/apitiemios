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

Route::get('/', function () {return view('app');});
Route::get('/dashboard', function () {return view('app');});
Route::get('/dashboard/arsip', function () {return view('app');});
Route::get('/dashboard/catatan', function () {return view('app');});
Route::get('/dashboard/jadwal', function () {return view('app');});
Route::get('/verifikasiEmail/{token}', function () {return view('app');});
