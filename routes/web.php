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
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('home')->defaults('menu', 'dashboard');
    Route::get('/design-groups', 'Admin\DesignController@designGroups')->name('design-group')->defaults('menu', 'design-group');
    Route::get('/design-groups/design-types/{design_group_id}', 'Admin\DesignController@designTypes')->name('design-types')->defaults('menu', 'design-group');
    Route::get('/design-groups/design-types/designs/{design_type_id}/{design_group_id}', 'Admin\DesignController@designs')->name('designs')->defaults('menu', 'design-group');
    Route::get('/profile', 'Admin\UsersController@index')->name('profile')->defaults('menu', 'profile');
});
