<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{

    public function index()
    {
        return view('app');
    }

    public function config()
    {
        return view('config');
    }

    public function home()
    {
        return view('home');
    }

    public function setup()
    {
        /** @var User $user */
        $user = auth()->user();
        if (Config::get('app.env') === 'staging' && $user->isAdmin()) {
            return response()->json([
//            'optimize' => Artisan::call('optimize'), // FIXME: can't be used without proc_open
                'route:cache' => Artisan::call('route:cache'),
                'cache:clear' => Artisan::call('cache:clear'),
                'migrate' => Artisan::call('migrate')
            ]);
        }
        return abort(404);
    }
}
