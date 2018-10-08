<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;

class Lesson extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Lesson::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
      'id',
      'name',
      'courseident',
      'shortname',
      'professor',
      'classname',
      'place',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request) {
        return [
          ID::make()->sortable(),

          Text::make('Name')
            ->sortable()
            ->rules('required', 'max:255'),

          Text::make('Shortname')
            ->sortable()
            ->rules('required', 'max:255'),

          Text::make('Courseident')
            ->sortable()
            ->rules('required', 'max:255'),

          Text::make('Professor')
            ->sortable()
            ->rules('required', 'max:255'),

          Text::make('Classname')
            ->sortable()
            ->rules('required', 'max:255'),

          Markdown::make('Links')
            ->sortable()
            ->rules('max:1000'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request) {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request) {
        return [];
    }
}
