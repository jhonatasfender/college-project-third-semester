<?php

use Faker\Generator as Faker;

$factory->define(
    \App\Models\Products::class,
    function (Faker $faker) {
        return [
            'name' => $faker->unique()->word() . " - " . $faker->unique()->name,
            'description' => $faker->sentence(50),
            'price' => $faker->randomFloat(2, 0, 1000),
            'expiration_date' => $faker->dateTime()
        ];
    }
);
