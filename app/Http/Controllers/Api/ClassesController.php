<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClassesController extends Controller
{
    /**
     * Show all the classes.
     *
     * @return array
     */
    public function index()
    {
        $classes = DB::table('lessons')->select('classname')->groupBy('classname')->get();
        return ['data'=>$classes];
    }
}
