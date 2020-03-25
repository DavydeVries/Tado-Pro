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

Route::group(['prefix' => 'tado'], function () {
    Route::get('/setup_check', 'Tado\BaseController@setupCheck');
    Route::get('/zones', 'Tado\ZonesController@index');
    Route::get('/zones/{id}', 'Tado\ZonesController@get');
});
