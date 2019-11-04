<?php

namespace Dewsign\NovaEvents\Database\Seeds;

use Illuminate\Database\Seeder;
use Dewsign\NovaEvents\Models\Event;
use Dewsign\NovaEvents\Models\EventCategory;
use Dewsign\NovaEvents\Models\EventSlot;
use Dewsign\NovaEvents\Models\EventLocation;
use Dewsign\NovaEvents\Models\EventOrganiser;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        factory(config('nova-events.models.event', Event::class), 6)->create();
        factory(EventLocation::class, 5)->create();
        factory(config('nova-events.models.event-slot', EventSlot::class), 15)->create();
        factory(EventOrganiser::class, 4)->create();
        factory(config('nova-events.models.category', EventCategory::class), 5)->create();

        config('nova-events.models.event', Event::class)::all()->each(function ($event) {
            $event->categories()->attach(config('nova-events.models.category', EventCategory::class)::inRandomOrder()->take(rand(1, 3))->get());
            $event->organisers()->attach(EventOrganiser::inRandomOrder()->take(rand(1, 3))->get());
            $event->save();
        });

        app(config('nova-events.models.event-slot', EventSlot::class))->all()->each(function ($eventSlot) {
            $eventSlot->event_location_id = EventLocation::inRandomOrder()->first()->id;
            $eventSlot->save();
        });


    }
}