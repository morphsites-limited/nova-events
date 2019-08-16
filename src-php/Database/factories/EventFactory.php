<?php

use Faker\Generator as Faker;
use Dewsign\NovaEvents\Models\Event;

$factory->define(Event::class, function (Faker $faker) {
    $titlePre = [
        'County',
        'Family',
        'Charity',
        'Night-time',
        'Live',
        'Social'
    ];
    $titleSuf = [
        'BBQ',
        'Concert',
        'Picnic',
        'Tour',
        'Show',
        'Market'
    ];
    return [
        'active' => $faker->boolean(90),
        'priority' => $faker->numberBetween(1, 100),
        'title' => $name = "{$faker->randomElement($titlePre)} {$faker->randomElement($titleSuf)}",
        'long_desc' => $faker->realText(rand(70, 100)),
        'short_desc' => $faker->realText(rand(10, 30)),
        'start_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 months'),
        'end_date' => $faker->dateTimeBetween($startDate = '+2 months', $endDate = '+4 months'),
    ];
});