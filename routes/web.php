<?php


Route::get('/', 'HomeController@index')->name('index');
Route::match(['get', 'post'], '/login', 'AuthController@login')->name('auth.login');
Route::match(['get', 'post'], '/join', 'AuthController@register')->name('auth.register');
Route::match(['get', 'post'], '/reset-password', 'AuthController@reset')->name('auth.reset');

// Route::group(['middleware' => ['auth', 'auth.basic', 'adaccess']], function () {
	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
	Route::resource('region', 'RegionController');
	Route::put('region/restore/{region}', 'RegionController@restore')->name('region.restore');

	Route::resource('city', 'CityController');
	Route::put('city/restore/{city}', 'CityController@restore')->name('city.restore');

	Route::resource('feature_type', 'FeatureTypeController');
	Route::put('feature_type/restore/{feature_type}', 'FeatureTypeController@restore')->name('feature_type.restore');

	Route::resource('property_type', 'PropertyTypeController');
	Route::put('property_type/restore/{property_type}', 'PropertyTypeController@restore')->name('property_type.restore');

	Route::resource('property_status', 'PropertyStatusController');
	Route::put('property_status/restore/{property_status', 'PropertyStatusController@restore')->name('property_status.restore');

	Route::resource('amenity', 'AmenityController');
	Route::put('amenity/restore/{amenity}', 'AmenityController@restore')->name('amenity.restore');

	Route::resource('payment_method', 'PaymentMethodController');
	Route::put('payment_method/restore/{payment_method}', 'PaymentMethodController@restore')->name('payment_method.restore');

	Route::resource('property', 'PropertyController');
	Route::put('property/restore/{property}', 'PropertyController@restore')->name('property.restore');
// });
