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
        factory(Event::class, 6)->create();
        factory(EventLocation::class, 5)->create();
        factory(EventSlot::class, 15)->create();
        factory(EventOrganiser::class, 4)->create();
        factory(EventCategory::class, 5)->create();

        Event::all()->each(function ($event) {
            $event->event_location_id = EventLocation::inRandomOrder()->first()->id;
            $event->categories()->attach(EventCategory::inRandomOrder()->take(rand(1, 3))->get());
            $event->organisers()->attach(EventOrganiser::inRandomOrder()->take(rand(1, 3))->get());
            $event->save();
        });

        EventSlot::all()->each(function ($eventSlot) {
            $eventSlot->event_location_id = EventLocation::inRandomOrder()->first()->id;
            $eventSlot->save();
        });


    }
}