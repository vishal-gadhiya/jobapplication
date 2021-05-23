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

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::group(['as' => 'admin.'], function() {

	Route::redirect('/', '/admin/login');

	// Login
	Route::inertia('/login', 'Admin/Auth/Login')
		->middleware('guest')
		->name('login');

	Route::post('/login', 'Auth\LoginController@store')
		->middleware('guest')
		->name('login');

	// Logout
	Route::post('/logout', 'Auth\LoginController@destroy')
		->middleware('auth')
		->name('logout');

	Route::group(['middleware' => ['auth']], function() {

		// Dashboard
		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

		Route::resource('applications', 'ApplicationController')->except([
			'create', 'show', 'update'
		]);

	});

});
