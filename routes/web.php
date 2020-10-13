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
Auth::routes();
Route::get('/', 'IndexController@index');
Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function () { 
    Route::get('/dashboard', function() { return view('admin.dashboard')->with('menu', 'home'); })->name('home')->defaults('menu', 'dashboard');
});
