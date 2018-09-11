<?php

use Faker\Generator as Faker;

$factory->define(
    \App\Models\ProductImages::class,
    function (Faker $faker) {
        return [
            'file' => $faker->image(
                'storage/app/public/image',
                400,
                300,
                null,
                false
            ),
            'products_id' => function () {
                return factory(\App\Models\Products::class)->create()->id;
            },
        ];
    }
);
