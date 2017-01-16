<?php

Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'HomeController@index')->name('index');
	Route::match(['get', 'post'], '/login', 'AuthController@login')->name('auth.login');

	Route::group(['middleware' => ['auth', 'auth.basic']], function () {
		Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
	});
});