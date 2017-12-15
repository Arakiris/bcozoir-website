<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->words(4, true),
        'body' => $faker->paragraph(6, true),
        'date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 years', $timezone = date_default_timezone_get()),
        'videos' => 0,
    ];
});

$factory->state(App\News::class, 'without', function (Faker $faker) {
    return [
        'photos' => 0,
    ];
});

$factory->state(App\News::class, 'photos', function (Faker $faker) {
    return [
        'photos' => 1,
    ];
});

