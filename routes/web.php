<?php

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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users/password', 'ChangePasswordController@edit')->name('users.password');
    Route::patch('/users/password', 'ChangePasswordController@update')->name('users.update');

    Route::get('/users/@me/edit', 'HomeController@edit')->name('users.edit');
    Route::patch('/users/@me/edit', 'HomeController@update')->name('users.update');
});
