<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('lessons', 'Api\LessonController', ['only' => ['index', 'show']]);
Route::resource('classes', 'Api\ClassesController', ['only' => ['index']]);
Route::resource('modules', 'Api\ModulesController', ['only' => ['index', 'show']]);

Route::middleware('auth:api')->group(function() {
    Route::get('/user', 'Api\UserController@index');
    Route::get('/webservice/fetch','Api\WebserviceController@fetch')->name('webservice.fetch');
});
