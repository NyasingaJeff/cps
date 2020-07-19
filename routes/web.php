<?php

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::any( '/records/{id}/clamp', 'RecordsController@clamp')->name('records.clamp');
	Route::any('/records/{id}/impound', 'RecordsController@impound')->name('records.impound');
	Route::any('/records/{id}/impound', 'RecordsController@impound')->name('records.impound');
	Route::any('/spaces/{id}/reserve','SpacesController@reserve')->name('space.reserve');
	Route::any('reservation','SpacesController@reservation')->name('space.reservation');
	Route::any('/record/{id}/clamp','RecordsController@clamp')->name('records.clamp');
	Route::any('/record/{id}/impound','RecordsController@impound')->name('records.impound');
	Route::any('/record/offender','RecordsController@offender')->name('records.offender');
	Route::any('reserves/create', function()
	{	return view('reserves.create');
	})->name('reserves.create');
	Route::post('search', 'SearchesController@search')->name('search');
	Route::get('/spaces/{id}/pdf','SpacesController@export_pdf')->name('spaces.pdf');
	Route::any('pay', function()
	{	return view('records.pay');
	})->name('records.pay');
	Route::get('/tasks/{id}/do','TasksController@do')->name('tasks.do');
	Route::get('client/{id}/report', 'ClientsController@export_pdf')->name('client.pdf');
	Route::get('client/{id}/chargesheet', 'ClientsController@chargesheet_export_pdf')->name('chargesheet.pdf');
	Route::post('rolespermissions/store','RolesAndPermissionsController@store')->name('rolespermission.store');
	Route::get('rolesandpermissions','RolesAndPermissionsController@index')->name('rolespermission.index');
	Route::get('rolesandpermissions/create','RolesAndPermissionsController@create')->name('rolespermission.create');
	Route::any('reserves/{id}/edit','ReservesController@edit')->name('reserve.edit');
	Route::any('reserves/{id}/update','ReservesController@update')->name('reserve.update');
	Route::any('reserves/{id}/delete','ReservesController@destroy')->name('unreserve');
	Route::resources([
		'records'=> 'RecordsController',
		'spaces'=>'SpacesController',
		'tasks'=>'TasksController',
		'clients'=>'ClientsController',
		'crimes'=>'CrimesController'
		

	]);
	

});
Route :: get('/guest/park','GuestController@park')->name('guest.park');
Route :: post('/guest/park', 'GuestController@park_save')->name('guest_park.save');
Route :: get('/guest/request','GuestController@guest_request')->name('guest.request');
Route :: post('/guest/request', 'GuestController@request_save')->name('guest_request.save');
