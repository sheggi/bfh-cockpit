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
    public function index(Request $request)
    {
        if($request->all()) {
            $includeClasses = explode(',', $request->get('include_classes'));
            $includeModules = explode(',', $request->get('include_modules'));
            $excludeModules = explode(',', $request->get('exclude_modules'));
            $data = Lesson::with('links')->
                where(function($query) use($includeClasses, $includeModules){
                $query->whereIn('classname', $includeClasses)
                  ->orWhereIn('id', $includeModules)
                  ->orWhereIn('courseident', $includeModules);
            })->whereNotIn('id', $excludeModules)->whereNotIn('courseident', $excludeModules)->get()->toArray();

            return response()->json(['data' => $data]);
        }
        else {
            return response()->json(['data' => Lesson::all()]);
        }
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
