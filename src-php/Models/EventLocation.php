<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;

class EventLocation extends Model
{
    protected $table = 'nova_event_locations';

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function eventSlot()
    {
        return $this->belongsTo(EventSlot::class);
    }
}
