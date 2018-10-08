<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Lesson
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $courseident
 * @property string $shortname
 * @property string $professor
 * @property string $classname
 * @property int $dayofweek
 * @property string $start
 * @property string $end
 * @property string $place
 * @property string $room
 * @property string $links
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereClassname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereCourseident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereDayofweek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereProfessor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereShortname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereUpdatedAt($value)
 */
class Lesson extends Model
{
    /**
     * default values
     */
    protected $attributes = [
      'links' => ''
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'courseident', 'shortname', 'professor', 'classname', 'dayofweek', 'start', 'end', 'place', 'room', 'links'];

}
