<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $faker;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Products::with('images')
            ->with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Products::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        return $products;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        $products->update($request->all());

        return $products;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        $products->delete();

        return 204;
    }

    /**
     * [
     *   {
     *     id: 1,
     *     rating: 4.5,
     *     text: "We know there's plenty more to do, but we've never been this excited about an app update. Go ahead – take it for a spin, and yes, never have a bad meal!",
     *     time: "2 hours ago",
     *     liked: false,
     *     commented: true,
     *     num_likes: 0,
     *     num_comments: 0,
     *     photos: [
     *       {
     *         thumb: "assets/img/menu/r1_thumb.jpg",
     *         full_size: "assets/img/menu/r1.jpg"
     *       }
     *     ],
     *     author: {
     *       id: 1,
     *       username: "Cowntown Foodie",
     *       profile_picture: "assets/img/user/adam.jpg",
     *       num_reviews: 50,
     *       num_folowers: 111
     *     },
     *     place: {
     *       id: 1,
     *       name: "Patzeria Perfect Pizza",
     *       district: "Theater District",
     *       city: "New York City",
     *       photo: "assets/img/menu/r1_thumb.jpg",
     *     }
     *   },
     */
    public function reviews()
    {
        $return = [];
        $this->faker = \Faker\Factory::create('pt_BR');
        for ($j = 0; $j < 2; $j++) {
            $data = new \stdClass;
            $data->id = $this->faker->numberBetween(0, 1000);
            $data->rating = $this->faker->randomFloat(2, 0, 10);
            $data->text = $this->faker->sentence(50);
            $data->time = $this->faker->time;
            $data->liked = $this->faker->boolean;
            $data->commented = $this->faker->boolean;
            $data->num_likes = $this->faker->numberBetween(0, 100);
            $data->num_comments = $this->faker->numberBetween(0, 100);
            $data->photos = [];
            for ($i = 0; $i < $this->faker->numberBetween(0, 10); $i++) {
                $photos = new \stdClass;
                $photos->image = $this->faker->image(storage_path('app/public/image'), 480, 300, null, false);
                $data->photos[] = $photos;
            }

            $data->author = new \stdClass;
            $data->author->id = $this->faker->numberBetween(0, 1000);
            $data->author->username = $this->faker->unique()->name;
            $data->author->profile_picture = $this->faker->image(storage_path('app/public/image'), 200, 200, null, false);
            $data->author->num_reviews = $this->faker->numberBetween(0, 100);
            $data->author->num_folowers = $this->faker->numberBetween(0, 100);
            $data->place = new \stdClass;
            $data->place->id = $this->faker->numberBetween(0, 1000);
            $data->place->name = $this->faker->unique()->word() . " - " . $this->faker->unique()->name;
            $data->place->district = $this->faker->streetAddress;
            $data->place->city = $this->faker->city;
            $data->place->photo = $this->faker->image(storage_path('app/public/image'), 256, 256, null, false);
            $return[] = $data;
        }
        return $return;
    }
}
