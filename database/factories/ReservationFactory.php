<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'check_in' => $faker->dateTimeBetween('+2 days', '+5 days'),
        'check_out' => $faker->dateTimeBetween('+6 days', '+10 days'),
        'price' => $faker->numberBetween(100, 500)
    ];
});
