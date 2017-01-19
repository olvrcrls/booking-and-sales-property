<?php

Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'HomeController@index')->name('index');
	Route::match(['get', 'post'], '/login', 'AuthController@login')->name('auth.login');
	Route::match(['get', 'post'], '/reset-password', 'AuthController@reset')->name('auth.reset');

	// Route::group(['middleware' => ['auth', 'auth.basic']], function () {
		Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
		Route::resource('region', 'RegionController');
		Route::put('region/restore/{region}', 'RegionController@restore')->name('region.restore');

		Route::resource('city', 'CityController');
		Route::put('city/restore/{city}', 'CityController@restore')->name('city.restore');
	// });
});