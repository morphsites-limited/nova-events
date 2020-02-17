<?php

return [
    'images' => [
        'field' => 'Laravel\Nova\Fields\Image',
        'disk' => 'public',
    ],
    'models' => [
        'event' => 'Dewsign\NovaEvents\Models\Event',
        'event-slot' => 'Dewsign\NovaEvents\Models\EventSlot',
        'category' => 'Dewsign\NovaEvents\Models\EventCategory'
    ],
    'resources' => [
        'event' => 'Dewsign\NovaEvents\Nova\Event',
        'event-slot' => 'Dewsign\NovaEvents\Nova\EventSlot',
        'category' => 'Dewsign\NovaEvents\Nova\EventCategory'
    ],
    'enableArchive' => true,
    'enableDateFilter' => true,
];