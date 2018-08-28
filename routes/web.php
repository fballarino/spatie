<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', function (){ return view('dashboard/index');})->name('dashboard.index');

Route::get('/', 'PostController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('products', 'ProductController');

Route::resource('events', 'EventController');

Route::post('bookings/status/{booking}', 'BookingController@changeStatus')->name('bookings.status');

Route::resource('bookings', 'BookingController');

Route::resource('characters', 'CharacterController')->middleware('auth','character');

Route::post('characters/status/{character}', 'CharacterController@changeStatus')->name('characters.status');

Route::resource('banks', 'BankController');



