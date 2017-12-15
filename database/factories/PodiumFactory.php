<?php

use Faker\Generator as Faker;

$factory->define(App\Podium::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'slug' => $faker->slug,
    ];
});
