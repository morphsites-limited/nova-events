<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Webpage\Model;
use Maxfactor\Support\Webpage\Traits\HasMetaAttributes;

class EventOrganiser extends Model
{
    use HasActiveState;
    use HasMetaAttributes;

    protected $table = 'nova_event_organisers';

    public function events()
    {
        return $this->belongsToMany(Event::class, 'nova_event_organisers_nova_events', 'organiser_id', 'nova_event_id');
    }
}
