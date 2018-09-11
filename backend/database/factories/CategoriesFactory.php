<?php

use Faker\Generator as Faker;

$factory->define(
    \App\Models\Categories::class,
    function (Faker $faker) {
        return [
            'name' => $faker->name,
            'icon_image' => $faker->image(
                'storage/app/public/image',
                400,
                300,
                null,
                false
            )
        ];
    }
);
