<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::group(['as' => 'user.'], function() {

	Route::group(['as' => 'application.'], function() {

		Route::get('/', 'ApplicationController@index')->name('index');

		Route::post('/application/store', 'ApplicationController@store')->name('store');
	});

});
