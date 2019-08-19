<?php

namespace Dewsign\NovaEvents\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Dewsign\NovaEvents\Nova\Event;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class EventSlot extends Resource
{
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Dewsign\NovaEvents\Models\EventSlot';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Events';

    /**
     * Get the displayable label of the resource
     *
     * @return string
     */
    public static  function label()
    {
        return __('Event Slots');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Boolean::make('Active')->sortable()->rules('required', 'boolean'),
            Number::make('Priority')->sortable()->rules('required'),
            Text::make('Title')->sortable()->rules('required', 'max:254'),
            Text::make('Description', 'long_desc')->hideFromIndex(),
            Text::make('Short Description', 'short_desc'),
            config('nova-events.images.field')::make('Image')->disk(config('nova-events.images.disk'))->rules('nullable'),
            Text::make('Image Alt')->rules('nullable'),
            DateTime::make('Start Date')->nullable(),
            DateTime::make('End Date')->nullable()->hideFromIndex(),
            BelongsTo::make('Event Location', 'location', EventLocation::class)->nullable(),
            BelongsTo::make('Event', 'event', Event::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
