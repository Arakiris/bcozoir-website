<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\IsTrue;

$factory->define(App\League::class, function (Faker $faker) {
    $year = rand(2017, 2019);
    $beginningSeason = Carbon::create($year, 9, 1);
    $endSeason = Carbon::create($year + 1, 9, 1);

    return [
        'name' => $faker->words(4, true),
        'start_season' => $beginningSeason,
        'end_season' => $endSeason,
        'day_of_week' => $faker->randomElement(array('Lundi','Mardi','Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')),
        'is_accredited' => $faker->boolean(70),
        'team_name' => $faker->words(2, true),
        'place' => $faker->words(2, true),
        'result' => $faker->url,
    ];
});
