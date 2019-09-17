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
        $query->addSubSelect('start_date', EventSlot::select('start_date')
            ->whereColumn('event_id', 'nova_events.id')
            ->orderBy('start_date', 'asc'))
            ->addSubSelect('end_date', EventSlot::select('end_date')
            ->whereColumn('event_id', 'nova_events.id')
            ->orderBy('end_date', 'desc'))
            ->with('eventSlots');
    }

    // Return a formatted string to display an 'at a glance' date. (e.g. From 20 Oct, On 3rd March)
    public function getQuickDate()
    {
        if ($this->start_date->diffInDays($this->end_date) === 0) {
            return 'On ' . $this->start_date->format('j M');
        } else if ($this->start_date->gt(Carbon::now())) {
            return 'From ' . $this->start_date->format('j M');
        } else {
            return 'Until ' . $this->end_date->format('j M');
        }
    }

    public function getPrimaryCategoryAttribute()
    {
        return $this->categories->first();
    }

    public function eventSlots()
    {
        return $this->hasMany(EventSlot::class);
    }

    public function eventPrices()
    {
        return $this->hasMany(EventPrice::class);
    }

    public function locations()
    {
        return $this->hasManyThrough(EventLocation::class, EventSlot::class, 'event_id', 'id', 'id', 'event_location_id');
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
