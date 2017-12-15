<?php

use Faker\Generator as Faker;
use PHPUnit\Framework\Constraint\IsTrue;

$factory->define(App\League::class, function (Faker $faker) {
    return [
        'name' => $faker->words(4, true),
        'start_season' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '+4 years', $timezone = date_default_timezone_get()),
        'end_season' => $faker->dateTime(),
        'day_of_week' => $faker->randomElement(array('Lundi','Mardi','Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')),
        'is_accredited' => $faker->boolean(70),
        'team_name' => $faker->words(2, true),
        'place' => $faker->words(2, true),
        'result' => $faker->url,
    ];
});
