<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Webpage\Model;
use Maxfactor\Support\Webpage\Traits\HasMetaAttributes;

class EventCategory extends Model
{
    use HasActiveState;
    use HasMetaAttributes;

    protected $table = 'nova_event_categories';

    public function events()
    {
        return $this->belongsToMany(Event::class, 'nova_event_categories_nova_events', 'nova_event_category_id', 'nova_event_id');
    }
}
