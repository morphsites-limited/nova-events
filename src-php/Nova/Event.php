<?php

namespace Dewsign\NovaEvents\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Dewsign\NovaEvents\Nova\EventSlot;
use Laravel\Nova\Fields\BelongsToMany;
use Dewsign\NovaEvents\Nova\EventCategory;
use Dewsign\NovaEvents\Nova\EventLocation;
use Dewsign\NovaEvents\Nova\EventOrganiser;
use Laravel\Nova\Http\Requests\NovaRequest;

class Event extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Dewsign\NovaEvents\Models\Event';

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
            HasMany::make('Event Slots', 'eventSlots', EventSlot::class),
            BelongsToMany::make('Event Categories', 'categories', EventCategory::class),
            BelongsToMany::make('Event Organiser', 'organisers', EventOrganiser::class),
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
