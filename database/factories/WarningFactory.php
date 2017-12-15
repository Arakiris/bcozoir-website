<?php

use Faker\Generator as Faker;

$factory->define(App\Warning::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(2, true),
        'date_disappear' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+20 days', $timezone = date_default_timezone_get()),
    ];
});
