<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Webpage\Traits\HasMetaAttributes;

class EventLocation extends Model
{
    use HasActiveState;
    use HasMetaAttributes;

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
