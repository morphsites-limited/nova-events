<?php

use Illuminate\Support\Str;
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
        'title' => $title = "{$faker->unique()->randomElement($titlePre)} {$faker->unique()->randomElement($titleSuf)}",
        'slug' => Str::slug($title),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'image_alt' => $title,
        'long_desc' => $faker->realText(rand(70, 100)),
        'short_desc' => $faker->realText(rand(10, 30)),
    ];
});