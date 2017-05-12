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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('lessons', 'Api\LessonController', ['only' => ['index', 'show']]);
Route::resource('classes', 'Api\ClassesController', ['only' => ['index']]);
Route::resource('modules', 'Api\ModulesController', ['only' => ['index', 'show']]);

Route::middleware('auth:api')->get('/webservice_fetch','Api\WebserviceController@fetch');
