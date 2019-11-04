<?php

namespace Dewsign\NovaEvents\Models;

use Illuminate\Support\Carbon;
use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;
use Dewsign\NovaEvents\Models\EventPrice;
use Dewsign\NovaEvents\Models\EventCategory;
use Dewsign\NovaEvents\Models\EventLocation;
use Dewsign\NovaEvents\Models\EventOrganiser;
use Maxfactor\Support\Webpage\Traits\HasSlug;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Model\Traits\WithPrioritisation;
use Maxfactor\Support\Webpage\Traits\HasMetaAttributes;

class Event extends Model
{
    use HasSlug;
    use HasActiveState;
    use HasMetaAttributes;
    use WithPrioritisation;

    protected $table = 'nova_events';

    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * Get only ongoing events
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsOngoing($query)
    {
        return $query->whereHas('eventSlots', function ($q) {
                return $q->where('end_date', '>=', date('Y-m-d'))->where('start_date', '<=', date('Y-m-d'));
            });
    }

    /**
     * Get all events that are either upcoming or are on going.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcomingAndOnGoing($query)
    {
        return $query->whereHas('eventSlots', function ($q) {
            return $q->where('end_date', '>=', date('Y-m-d'));
        });
    }

    /**
     * Get only events that have ended
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasEnded($query)
    {
        return $query->whereHas('eventSlots', function ($q) {
            return $q->where('end_date', '<=', date('Y-m-d'));
        });
    }

    public function scopeWithComputedDates($query)
    {
        $query->addSubSelect('start_date', app(config('nova-events.models.event-slot', EventSlot::class))->select('start_date')
            ->whereColumn('event_id', 'nova_events.id')
            ->orderBy('start_date', 'asc'))
            ->addSubSelect('end_date', app(config('nova-events.models.event-slot', EventSlot::class))->select('end_date')
            ->whereColumn('event_id', 'nova_events.id')
            ->orderBy('end_date', 'desc'))
            ->with('eventSlots');
    }

    /**
     * Check if the this event runs over multiple days.
     *
     * @return boolean
     */
    public function isMultiDayEvent()
    {
        $slotDates = $this->eventSlots->map(function ($item) {
            return $item->start_date->toDateString();
        });

        return $slotDates->unique()->values()->count() !== 1;
    }

    // Return a formatted string to display an 'at a glance' date. (e.g. From 20 Oct, On 3rd March)
    public function getQuickDate()
    {
        if ($this->start_date->diffInDays($this->end_date) === 0) {
            return ['when' => 'On', 'day' => $this->start_date->format('j'), 'month' => $this->start_date->format('M')];
        } else if ($this->start_date->gt(Carbon::now())) {
            return ['when' => 'From', 'day' => $this->start_date->format('j'), 'month' => $this->start_date->format('M')];
        } else {
            return ['when' => 'Until ', 'day' => $this->end_date->format('j'), 'month' => $this->end_date->format('M')];
        }
    }

    public function getPrimaryCategoryAttribute()
    {
        return $this->categories->first();
    }

    public function eventSlots()
    {
        return $this->hasMany(config('nova-events.models.event-slot', EventSlot::class));
    }

    public function eventPrices()
    {
        return $this->hasMany(EventPrice::class);
    }

    public function locations()
    {
        return $this->hasManyThrough(EventLocation::class, config('nova-events.models.event-slot', EventSlot::class), 'event_id', 'id', 'id', 'event_location_id');
    }

    public function categories()
    {
        return $this->belongsToMany(config('nova-events.models.category', EventCategory::class), 'nova_event_categories_nova_events', 'nova_event_id', 'nova_event_category_id');
    }

    public function organisers()
    {
        return $this->belongsToMany(EventOrganiser::class, 'nova_event_organisers_nova_events', 'nova_event_id', 'organiser_id');
    }
}
