<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;
use Maxfactor\Support\Model\Traits\HasActiveState;

class EventPrice extends Model
{
    use HasActiveState;

    protected $table = 'nova_event_prices';

    public function event()
    {
        return $this->belongsTo(config('nova-events.models.event', Event::class));
    }
}
