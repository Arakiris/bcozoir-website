<?php

use Faker\Generator as Faker;

$factory->define(App\Tournament::class, function (Faker $faker) {
    return [
        'type_id' => rand(1, 3),
        'title' => $faker->words(4, true),
        'start_season' => $faker->date(),
        'end_season' => $faker->date(),
        'is_accredited' => $faker->boolean($chanceOfGettingTrue = 70),
        'place' => $faker->words(2, true),
        'is_rules_pdf' => 0,
        'rules_url' => $faker->url,
        'slug' => $faker->slug,
    ];
});

$factory->state(App\Tournament::class, 'passed', function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = date_default_timezone_get()),
        'is_finished' => 1,
        'listing' => '/upload/images/tmp/' .  $faker->image('public/storage/upload/images/tmp/', 640, 480, null, false),
        'lexer_url' => $faker->url,
        'report' => $faker->paragraphs(3, true),
    ];
});

$factory->state(App\Tournament::class, 'now', function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = date_default_timezone_get()),
        'is_finished' => 1,
        'listing' => '/upload/images/tmp/' .  $faker->image('public/storage/upload/images/tmp/', 640, 480, null, false),
        'lexer_url' => $faker->url,
        'report' => $faker->paragraphs(3, true),
    ];
});

$factory->state(App\Tournament::class, 'future', function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = date_default_timezone_get()),
        'is_finished' => 0,
    ];
});


