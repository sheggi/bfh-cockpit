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
    return view('app');
});
Route::get('/config', function () {
    return view('config');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/setup', function () {
    if (Config::get('app.env') === 'staging') {
        return response()->json([
//            'optimize' => Artisan::call('optimize'), // FIXME: can't be used without proc_open
//            'route:cache' => Artisan::call('route:cache'), // FIXME: LogicException api/v0/user not serializable because of Closure
            'cache:clear' => Artisan::call('cache:clear'),
            'migrate' => Artisan::call('migrate')
            ]);
    } else {
        abort(404);
    }
});
