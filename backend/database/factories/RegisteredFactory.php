<?php

use Faker\Generator as Faker;

$factory->define(
    App\Models\Registered::class,
    function (Faker $faker) {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'address' => $faker->address,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ];
    }
);
