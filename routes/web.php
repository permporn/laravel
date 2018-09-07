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

Route::get('/home', 'HomeController@index')->name('home');

$this->get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');

Route::get('/index', 'UsersManagementController@index');


// APP Routes Below
Route::group(['middleware' => 'web', 'namespace' => 'jeremykenedy\laravelusers\app\Http\Controllers'], function () {
    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
    ]);
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('search-users', 'jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@search')->name('search-users');
});
