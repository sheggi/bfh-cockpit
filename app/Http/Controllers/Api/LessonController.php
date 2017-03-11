<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lesson;

class LessonController extends Controller
{
    /**
     * Show all the lessons.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['data' => Lesson::all()]);
    }

    /**
     * Show the lesson with the given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json(['data' => Lesson::findOrFail($id)]);
    }
}
