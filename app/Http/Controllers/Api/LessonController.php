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
            $data = [];
            foreach ($includeClasses as $cl) {
                $data = array_merge($data, Lesson::where('classname', $cl)->get()->toArray());
            }
            foreach ($includeModules as $mod) {
                $data = array_merge($data, Lesson::where('courseident', $mod)->get()->toArray());
            }

            $data = array_values(array_filter($data,
                function ($module) use ($excludeModules) {
                    return !in_array($module['courseident'], $excludeModules);
                }));

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
