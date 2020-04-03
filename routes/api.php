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

Route::group(['prefix' => 'cars'], function () {
    Route::get('makes', 'CarMakeController@index')->name('makes');
    Route::get('models', 'CarModelController@index')->name('models');
    Route::get('list', 'CarController@index')->name('cars');
});
