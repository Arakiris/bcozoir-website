<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'place' => $faker->words(2, true),
        'date' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '+2 years', $timezone = date_default_timezone_get()),
        'slug' => $faker->slug,
    ];
});
