<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

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

Route::get('transactions/{id}/bank', 'TransactionController@showBankTransactions')->name('transactions.bank');

Route::get('transactions/{id}/add', 'TransactionController@addMovement')->name('transactions.add');

Route::post('transactions/verify', 'TransactionController@verifyMovements')->name('transactions.verify');

Route::resource('transactions', 'TransactionController');

Route::resource('signups', 'SignupController');

Route::get('signups/{event}/sign', 'SignupController@sign')->name('signups.sign');

Route::post('signups/{signup}/status', 'SignupController@status')->name('signups.status');

Route::get('attendances/{event}/signups', 'AttendanceController@displayEventSignups')->name('attendances.displaySignups');

Route::post('goldtracks/verify', 'GoldtrackController@verifyMovements')->name('goldtracks.verify');

Route::resource('goldtracks', 'GoldtrackController');

Route::resource('attendances', 'AttendanceController');

Route::resource('balances', 'BalanceController');

Route::resource('pricelists', 'PricelistController');