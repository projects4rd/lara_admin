<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'Admin\AdminDashboardController@index')->name('dashboard');

    Route::get('users', 'Admin\UserController@index')->name('users.index');
    Route::get('users', 'Admin\UserController@getUsers')->name('users.get');
    Route::resource('users', 'Admin\UserController');

    Route::resource('roles', 'Admin\RoleController');
    Route::resource('permissions', 'Admin\PermissionController');
});

Route::get('/home', 'HomeController@index')->name('home');
