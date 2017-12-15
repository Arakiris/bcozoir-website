<?php

use Faker\Generator as Faker;

$factory->define(App\Advert::class, function (Faker $faker) {
    return [
        'start_display' => $faker->dateTimeBetween($startDate = '-10 days', $endDate = 'now', $timezone = date_default_timezone_get()),
        'end_display' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 days', $timezone = date_default_timezone_get()),
    ];
});
