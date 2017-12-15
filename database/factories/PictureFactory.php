<?php

use Faker\Generator as Faker;

$factory->define(App\Picture::class, function (Faker $faker) {
    return [
        'title' => '<p>18 avril 2016<br>1 hdp Ozoir-la-Ferrière</p>'
    ];
});

$factory->state(App\Picture::class, 'member', function (Faker $faker) {
    return [
        'path' => '/upload/images/tmp/' .  $faker->image('public/storage/upload/images/tmp/', 150, 176, null, false)
    ];
});

$factory->state(App\Picture::class, 'normal', function (Faker $faker) {
    return [
        'path' => '/upload/images/tmp/' .  $faker->image('public/storage/upload/images/tmp/', 640, 480, null, false)
    ];
});
