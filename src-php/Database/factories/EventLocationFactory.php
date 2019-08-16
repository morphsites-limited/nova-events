<?php

use Faker\Generator as Faker;
use Dewsign\NovaEvents\Models\EventLocation;

$factory->define(EventLocation::class, function (Faker $faker) {
    return [
        'active' => $faker->boolean(90),
        'title' => $faker->cityPrefix() . ' ' . $faker->unique()->firstName(),
        'description' => $faker->realText(rand(70, 100)),
        'info_page_link' => $faker->domainName(),
    ];
});