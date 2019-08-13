<?php

namespace Dewsign\NovaEvents\Models;

use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;

class Event extends Model
{
    protected $table = 'nova_events';

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function eventSlots()
    {
        return $this->hasMany(EventSlot::class);
    }
}
