<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;

class EventOrganiser extends Model
{
    protected $table = 'nova_event_organisers';

    public function events()
    {
        return $this->belongsToMany(Event::class, 'nova_event_organisers_nova_events', 'organiser_id', 'nova_event_id');
    }
}
