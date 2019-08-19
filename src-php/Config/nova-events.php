<?php

return [
    'images' => [
        'field' => 'Laravel\Nova\Fields\Image',
        'disk' => 'public',
    ],
    'models' => [
        'event' => 'Dewsign\NovaEvents\Models\Event',
        'category' => 'Dewsign\NovaEvents\Models\EventCategory'
    ],
    'resources' => [
        'event' => 'Dewsign\NovaEvents\Nova\Event',
        'category' => 'Dewsign\NovaEvents\Nova\EventCategory'
    ],
];