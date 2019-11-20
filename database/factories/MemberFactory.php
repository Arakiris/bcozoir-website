<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'club_id' => rand (1, 4),
        'category_id' => rand (1, 4),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => $faker->randomElement($array = array('m', 'f')),
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'is_licensee' => rand (0, 2),
        'id_licensee' => str_random(10),
        'handicap' => rand (0, 60),
        'bonus' => rand (0, 60),
        'is_active' => $faker->boolean($chanceOfGettingTrue = 90),
        'historical_path' => NULL,
        'listing_url' => "https://www.google.com/"
    ];
});
