<?php

namespace Dewsign\NovaEvents\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Dewsign\NovaEvents\Nova\Event;
use Laravel\Nova\Fields\BelongsTo;
use Dewsign\NovaEvents\Models\EventPrice as EventPriceModel;
use Gkermer\TextAutoComplete\TextAutoComplete;

class EventPrice extends Resource
{
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Dewsign\NovaEvents\Models\EventPrice';

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
        return __('Event Prices');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $unique_titles = EventPriceModel::all()->unique('title');
        return [
            Sortable::make('Sort', 'id'),
            ID::make(),
            Boolean::make('Active')->sortable()->rules('required', 'boolean'),
            TextAutoComplete::make('Title')->items([
                $unique_titles->toArray(),
            ]),
            Text::make('Price')->sortable()->rules('required', 'max:254'),
            BelongsTo::make('Event', 'event', config('nova-events.resources.event', Event::class)),
        ];
    }
}
