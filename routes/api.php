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

// 获取beacon列表
Route::get('/beacons', 'BeaconController@index');
// 录入beacon
Route::post('/beacon/create', 'BeaconController@create');
// 更新beacon
Route::post('/beacon/{id}', 'BeaconController@update')->where('id', '[0-9]+');
// 删除beacon
Route::post('/beacon/{id}/delete', 'BeaconController@delete')->where('id', '[0-9]+');