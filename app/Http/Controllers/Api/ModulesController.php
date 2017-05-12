<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ModulesController extends Controller
{
    /**
     * Show all the classes.
     *
     * @return array
     */
    public function index()
    {
        $modules = DB::table('lessons')->select('courseident', 'shortname', 'name')->groupBy('courseident')->get();
        return ['data' => $modules];
    }


    /**
     * Show the lesson with the given id.
     *
     * @param  string  $id shortname
     * @return array
     */
    public function show($id)
    {
        $modules = DB::table('lessons')->select('courseident', 'shortname', 'name')->where('shortname', $id)->groupBy('courseident')->get();
        return ['data' => $modules];
    }
}
