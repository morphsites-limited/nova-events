<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Dewsign\NovaEvents\Models\EventOrganiser;

$factory->define(EventOrganiser::class, function (Faker $faker) {
    return [
        'active' => $faker->boolean(90),
        'name' => $name = $faker->company,
        'slug' => Str::slug($name),
        'website' => $faker->domainName(),
        'info' => $faker->realText(rand(30, 50))
    ];
});
