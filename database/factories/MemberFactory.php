<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'club_id' => rand (1, 10),
        'category_id' => rand (1, 9),
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'sex' => $faker->randomElement($array = array('m', 'f')),
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'is_licensee' => $faker->boolean($chanceOfGettingTrue = 30),
        'id_licensee' => str_random(10),
        'handicap' => rand (0, 60),
        'bonus' => rand (0, 60),
        'is_active' => $faker->boolean($chanceOfGettingTrue = 90),
    ];
});
