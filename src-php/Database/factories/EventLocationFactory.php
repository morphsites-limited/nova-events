<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Dewsign\NovaEvents\Models\EventLocation;

$factory->define(EventLocation::class, function (Faker $faker) {
    return [
        'active' => $faker->boolean(90),
        'title' => $title = $faker->cityPrefix() . ' ' . $faker->unique()->firstName(),
        'slug' => Str::slug($title),
        'description' => $faker->realText(rand(70, 100)),
        'info_page_link' => $faker->domainName(),
    ];
});