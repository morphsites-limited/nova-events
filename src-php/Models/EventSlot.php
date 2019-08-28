<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventLocation;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Model\Traits\WithPrioritisation;

class EventSlot extends Model
{
    use HasActiveState;
    use WithPrioritisation;

    protected $table = 'nova_event_slots';

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function event()
    {
        return $this->belongsTo(config('nova-events.models.event', Event::class));
    }

    public function location()
    {
        return $this->belongsTo(EventLocation::class, 'event_location_id');
    }
}
