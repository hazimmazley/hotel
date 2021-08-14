<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hotel;
use Faker\Generator as Faker;

$factory->define(Hotel::class, function (Faker $faker) {
    return [
        'name' => rtrim (ucfirst($faker->text(20)), '.'),
        'description' => $faker->sentence(),
        'created_at' => $faker->dateTimeBetween('-20 days', '-10 days'),
        'updated_at' => $faker->dateTimeBetween('-5 days', '-1 days'),

    ];
});
