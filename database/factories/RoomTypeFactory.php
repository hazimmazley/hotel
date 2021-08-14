<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RoomType;
use Faker\Generator as Faker;

$factory->define(RoomType::class, function (Faker $faker) {
    return [
        'size' => $faker->numberBetween(1, 5),
        'prize' => $faker->numberBetween(100, 500),
        'amount' => $faker->numberBetween(1, 10),
        'created_at' => $faker->dateTimeBetween('-9 days', '-4 days'),
        'updated_at' => $faker->dateTimeBetween('-2 days', '-1 minute'),
    ];
});
