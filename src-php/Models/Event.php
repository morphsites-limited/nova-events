<?php

namespace Dewsign\NovaEvents\Models;

use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;
use Dewsign\NovaEvents\Models\EventCategory;
use Dewsign\NovaEvents\Models\EventLocation;
use Dewsign\NovaEvents\Models\EventOrganiser;
use Maxfactor\Support\Model\Traits\HasActiveState;

class Event extends Model
{
    use HasActiveState;

    protected $table = 'nova_events';

    protected $dates = [
        'start_date',
        'end_date',
    ];

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
        return $this->belongsToMany(EventCategory::class, 'nova_event_categories_nova_events', 'nova_event_id', 'nova_event_category_id');
    }

    public function organisers()
    {
        return $this->belongsToMany(EventOrganiser::class, 'nova_event_organisers_nova_events', 'nova_event_id', 'organiser_id');
    }
}
