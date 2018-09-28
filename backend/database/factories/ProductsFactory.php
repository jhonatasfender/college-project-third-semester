<?php

use Faker\Generator as Faker;

$factory->define(
    \App\Models\Products::class,
    function (Faker $faker) {
        return [
            'name' => $faker->unique()->word() . " - " . $faker->unique()->name,
            'description' => $faker->sentence(50),
            'price' => $faker->randomFloat(2, 0, 1000),
            'expiration_date' => $faker->dateTime(),

            'district' => $faker->streetAddress,                 //: "Theater District",
            'city' => $faker->city,                              //: "New York City",
            'website' => $faker->url,                            //: "http://daoduythanh.com",
            'phone' => $faker->e164PhoneNumber,                  //: "+84988888888",
            'address' => $faker->address,                        //: "231W 46th street, New York",

            'num_reviews' => $faker->numberBetween(0, 100),      //: 30,
            'num_photos' => $faker->numberBetween(0, 100),       //: 32,
            'num_bookmarks' => $faker->numberBetween(0, 100),    //: 27,
            'num_check_in' => $faker->randomNumber(),            //: 1316,
            'num_votes' => $faker->numberBetween(0, 400),        //: 232,
            'cost' => $faker->randomNumber(),                    //: 20,
            'accepted_card' => 1,                                //: 1,
            'accepted_cash' => 1,                                //: 1,

            'rating' => $faker->randomFloat(2, 0, 10),           //: 4.1,

            'bookmarked' => $faker->boolean,                     //: false,
            'latitude' => $faker->latitude(),                    // 77.147489
            'longitude' => $faker->longitude()                   // 86.211205
        ];
    }
);
