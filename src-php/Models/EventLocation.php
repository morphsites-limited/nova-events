<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;

class EventLocation extends Model
{
    protected $table = 'nova_event_locations';

    public function events()
    {
        return $this->hasMany(Event::class, 'event_location_id', 'id');
    }

    public function eventSlots()
    {
        return $this->hasMany(EventSlot::class, 'event_location_id', 'id');
    }
}
