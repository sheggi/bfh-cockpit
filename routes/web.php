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

Auth::routes();

Route::get('/', 'HomeController@index')->name('timetable');
Route::get('/config','HomeController@config')->name('configuration');

Route::middleware('auth')->group(function (){
    Route::get('/home', 'HomeController@home');
    Route::get('/setup', 'HomeController@setup');
});
