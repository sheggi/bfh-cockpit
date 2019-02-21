<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class WebserviceController extends Controller
{
    /**
     * fetch all lessons from the bfh webservice
     *
     * @return Response
     */
    public function fetch() {
        if (auth()->user()->isAdmin()) {
            $url = 'https://mybfh.bfh.ch/webservice/?action=get_tt_entries&flat&_dc=' . time();
            $fetched = json_decode(file_get_contents($url), true);

            if ($fetched && $fetched['message'] === 'No problem') {
                $lessons = $fetched['data'];
                foreach ($lessons as $lessonData) {

                    // don't save if WPM is other than I_
                    if (str_contains('WPM', $lessonData['classname']) &&
                      !str_contains('I_', $lessonData['classname'])) {
                        continue;
                    }

                    $lessonData['id'] = $lessonData['uid'];
                    $lessonData['name'] = $lessonData['name_de'];
                    unset ($lessonData['uid']);
                    unset ($lessonData['name_de']);
                    $lesson = Lesson::firstOrNew(['id' => $lessonData['id']], $lessonData);
                    $lesson->save();
                }

            } else {
                return abort(500);
            }
            return response()->json(Lesson::selectRaw('count(*)')->get());
        }

        return abort(404);
    }
}
