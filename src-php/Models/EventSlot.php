<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventLocation;

class EventSlot extends Model
{
    protected $table = 'nova_event_slots';

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function location()
    {
        return $this->hasOne(EventLocation::class);
    }
}
