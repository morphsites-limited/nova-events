<?php

namespace Dewsign\NovaEvents\Models;

use Dewsign\NovaEvents\Models\Event;
use Maxfactor\Support\Webpage\Model;
use Dewsign\NovaEvents\Models\EventSlot;
use Maxfactor\Support\Webpage\Traits\HasSlug;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Webpage\Traits\HasMetaAttributes;

class EventLocation extends Model
{
    use HasSlug;
    use HasActiveState;
    use HasMetaAttributes;

    protected $table = 'nova_event_locations';

    private $metaDefaults = [
        'browser_title' => 'title',
        'h1' => 'title',
        'nav_title' => 'title',
    ];

    protected $appends = [
        'name',
    ];

    /**
     * For meta attributes and repeaters that look for a name field (Hyperlink blocks)
     *
     * @return String
     */
    public function getNameAttribute()
    {
        return $this->title;
    }

    public function eventSlots()
    {
        return $this->hasMany(config('nova-events.models.event-slot', EventSlot::class), 'event_location_id', 'id');
    }
}
