<?php

namespace Dewsign\NovaEvents\Models;

use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;
use Dewsign\NovaEvents\Models\EventCategory;
use Dewsign\NovaEvents\Models\EventLocation;
use Dewsign\NovaEvents\Models\EventOrganiser;
use Maxfactor\Support\Webpage\Traits\HasSlug;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Webpage\Traits\HasMetaAttributes;

class Event extends Model
{
    use HasSlug;
    use HasActiveState;
    use HasMetaAttributes;

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
        return $query->where('end_date', '>=', date('Y-m-d'));
    }

    /**
     * Get only events that have ended
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasEnded($query)
    {
        return $query->where('end_date', '<=', date('Y-m-d'));
    }

    public function getPrimaryCategoryAttribute()
    {
        return $this->categories->first();
    }

    public function eventSlots()
    {
        return $this->hasMany(EventSlot::class);
    }

    public function location()
    {
        return $this->belongsTo(EventLocation::class, 'event_location_id', 'id');
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
