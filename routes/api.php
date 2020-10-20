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
Route::get('/get-design-info/{id}', 'API\DesignController@index');
// Design Groups
Route::post('/edit-design-group', 'API\DesignController@modifyDesignGroup');
Route::post('/add-design-group', 'API\DesignController@createDesignGroup');
Route::delete('/delete-design-group', 'API\DesignController@deleteDesignGroup');
// Design Types
Route::post('/edit-design-type', 'API\DesignController@modifyDesignType');
Route::post('/add-design-type', 'API\DesignController@createDesignType');
Route::delete('/delete-design-type', 'API\DesignController@deleteDesignType');
// Designs
Route::post('/edit-design', 'API\DesignController@modifyDesign');
Route::post('/add-design', 'API\DesignController@createDesign');
Route::delete('/delete-design', 'API\DesignController@deleteDesign');
Route::put('/update-default', 'API\DesignController@updateDefault');

//Profile
Route::post('/edit-profile', 'API\UsersController@updateProfile');
Route::post('/update-password', 'API\UsersController@updatePassword');

