<?php

namespace Dewsign\NovaEvents\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Textarea;
use Dewsign\NovaEvents\NovaEvents;
use Benjaminhirsch\NovaSlugField\Slug;
use Dewsign\NovaEvents\Nova\EventSlot;
use Laravel\Nova\Fields\BelongsToMany;
use Dewsign\NovaEvents\Nova\EventPrice;
use Dewsign\NovaEvents\Nova\EventCategory;
use Dewsign\NovaEvents\Nova\EventOrganiser;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Maxfactor\Support\Webpage\Nova\MetaAttributes;

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
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Events';

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
            $this->templateOptions(),
            Boolean::make('Active')->sortable()->rules('required', 'boolean'),
            Number::make('Priority')->sortable()->rules('required', 'integer'),
            TextWithSlug::make('Title')->sortable()->rules('required', 'max:254')->slug('slug'),
            Slug::make('Slug')->rules('required', 'alpha_dash', 'max:254')->hideFromIndex(),
            Markdown::make('Description', 'long_desc')->hideFromIndex(),
            Textarea::make('Short Description', 'short_desc'),
            config('nova-events.images.field')::make('Image')->disk(config('nova-events.images.disk'))->rules('nullable'),
            Text::make('Image Alt')->rules('nullable')->hideFromIndex(),
            MetaAttributes::make(),

            HasMany::make('Event Slots', 'eventSlots', EventSlot::class),
            HasMany::make('Event Prices', 'eventPrices', EventPrice::class),
            BelongsToMany::make('Event Categories', 'categories', config('nova-events.resources.category', EventCategory::class)),
            BelongsToMany::make('Event Organiser', 'organisers', EventOrganiser::class),
        ];
    }

    private function templateOptions()
    {
        $options = NovaEvents::availableTemplates();
        if (count($options) <= 1) {
            return $this->merge([]);
        }
        return $this->merge([
            Select::make('Template')
                ->options($options)
                ->displayUsingLabels()
                ->hideFromIndex()
        ]);
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
