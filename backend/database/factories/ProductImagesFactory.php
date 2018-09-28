<?php

use Faker\Generator as Faker;

$factory->define(
    \App\Models\ProductImages::class,
    function (Faker $faker) {
        $img = $faker->image('storage/app/public/image', 1920, 1080, null, false);
        if (!$img) {
            $img = $faker->unique()->word();
        }
        return [
            'file' => $img,
        ];
    }
);
