<?php

use Faker\Generator as Faker;

$factory->define(
    \App\Models\Categories::class,
    function (Faker $faker) {
        $img = $faker->image('storage/app/public/image', 400, 300, null, false);
        if (!$img) {
            $img = $faker->unique()->word();
        }
        return [
            'name' => $faker->name,
            'icon_image' => $img,
        ];
    }
);
