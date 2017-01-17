<?php

Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'HomeController@index')->name('index');
	Route::match(['get', 'post'], '/login', 'AuthController@login')->name('auth.login');
	Route::match(['get', 'post'], '/reset-password', 'AuthController@reset')->name('auth.reset');

	// Route::group(['middleware' => ['auth', 'auth.basic']], function () {
		Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
	// });
});