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
Route::post('/edit-design-group', 'API\DesignController@modifyDesignGroup');
Route::post('/add-design-group', 'API\DesignController@createDesignGroup');
