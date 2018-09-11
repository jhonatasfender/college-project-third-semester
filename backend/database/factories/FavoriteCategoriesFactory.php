<?php

use Faker\Generator as Faker;

$factory->define(
    \App\Models\FavoriteCategories::class,
    function (Faker $faker) {
        return [
            'id_category' => $faker->randomNumber(),
            'id_user' => $faker->randomNumber(),
        ];
    }
);
