<?php

use Faker\Generator as Faker;
use Dewsign\NovaEvents\Models\Event;
use Dewsign\NovaEvents\Models\EventSlot;

$factory->define(config('nova-events.models.event-slot', EventSlot::class), function (Faker $faker) {
    $event = app(config('nova-events.models.event', Event::class))->inRandomOrder()->first();
    return [
        'event_id' => $event->id,
        'active' => $faker->boolean(90),
        'priority' => $faker->numberBetween(1, 100),
        'title' => $event->title . ' - Slot ' . $faker->unique()->numberBetween(1, 25),
        'long_desc' => $faker->realText(rand(70, 100)),
        'short_desc' => $faker->realText(rand(10, 30)),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'image_alt' => $event->title,
        'start_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 months'),
        'end_date' => $faker->dateTimeBetween($startDate = '+2 months', $endDate = '+4 months'),
   ];
});