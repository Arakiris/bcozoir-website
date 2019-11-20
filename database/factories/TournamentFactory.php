<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Tournament::class, function (Faker $faker) {
    $year = rand(2017, 2019);
    $beginningSeason = Carbon::create($year, 9, 1);
    $endSeason = Carbon::create($year + 1, 9, 1);
    $date = $faker->dateTimeBetween($beginningSeason, $endSeason, $timezone = date_default_timezone_get());
    $carbonDate = Carbon::createFromTimeStamp($date->getTimestamp());
    $now = Carbon::now();

    $finish = 0;
    if($now->greaterThan($carbonDate)) {
        $finish = 1;
    }

    $title = $faker->sentence;
    $slug = str_slug($title, '-');

    return [
        'type_id' => rand(1, 3),
        'title' => $title,
        'start_season' => $beginningSeason,
        'end_season' => $endSeason,
        'date' => $date,
        'formation' => 0,
        'is_accredited' => $faker->boolean($chanceOfGettingTrue = 70),
        'place' => $faker->words(2, true),
        'is_rules_pdf' => 0,
        'rules_url' => $faker->url,
        'slug' => $faker->slug,
        'is_finished' => $finish,
        'listing' => NULL,
        'lexer_url' => NULL,
        'report' => NULL,
        'slug' => $slug,
    ];;
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


