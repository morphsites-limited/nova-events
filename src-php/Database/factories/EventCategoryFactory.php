<?php

use Faker\Generator as Faker;
use Dewsign\NovaEvents\Models\EventCategory;

$factory->define(EventCategory::class, function (Faker $faker) {
    $categories = [
        'Family Friendly',
        'Late Night',
        'Live Music',
        'Arts',
        'Hands On',
        'Educational',
        'Food'
    ];
    return [
        'active' => $faker->boolean(90),
        'title' => $faker->unique()->randomElement($categories),
    ];
});