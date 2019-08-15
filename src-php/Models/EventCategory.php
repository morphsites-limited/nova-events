<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;

class EventCategory extends Model
{
    protected $table = 'nova_event_categories';

    public function events()
    {
        return $this->belongsToMany(Event::class, 'nova_event_categories_nova_events', 'nova_event_category_id', 'nova_event_id');
    }
}
