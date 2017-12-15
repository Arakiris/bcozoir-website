<?php

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [
        'average' => $faker->randomFloat(2, 30.0, 300.0),
        'number_lines' => $faker->randomDigitNotNull(),
    ];
});
