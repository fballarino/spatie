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

Route::post('bookings/status', 'BookingController@changeStatus')->name('bookings.status');

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

Route::get('signups/{event}/cancel', 'SignupController@cancel')->name('signups.cancel');

Route::post('signups/{signup}/status', 'SignupController@status')->name('signups.status');

Route::get('attendances/{event}/signups', 'AttendanceController@displayEventSignups')->name('attendances.displaySignups');

Route::get('attendances/member', 'AttendanceController@memberDisplay')->name('attendances.member');

Route::post('goldtracks/verify', 'GoldtrackController@verifyMovements')->name('goldtracks.verify');

Route::resource('goldtracks', 'GoldtrackController');

Route::resource('attendances', 'AttendanceController');

Route::get('balances/advertiser', 'BalanceController@getAdvertiserFees')->name('balances.advertiser');

Route::resource('balances', 'BalanceController');

Route::resource('pricelists', 'PricelistController');

Route::resource('teams', 'TeamController');

Route::get('teamsignups/{id}/cancel', 'TeamSignupController@cancelSignup')->name('teamsignups.cancel');

Route::resource('teamsignups', 'TeamSignupController');

Route::resource('tools/evntmngr', 'ManagerEventController');

Route::resource('articles', 'ArticleController');

Route::get('tools/blncmngr', 'BalanceController@getBalanceUsers')->name('balances.all');

Route::get('tools/blncmngr/attendance/{id}', 'AttendanceController@attendanceDisplay')->name('balances.tools.attendance');