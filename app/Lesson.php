<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
