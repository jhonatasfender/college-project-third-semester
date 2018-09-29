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
        $this->faker = \Faker\Factory::create('pt_BR');
        $data = new \stdClass;
        // $data->id = 
        // $data->rating = 
        // $data->text = 
        // $data->time = 
        // $data->liked = 
        // $data->commented = 
        // $data->num_likes = 
        // $data->num_comments = 
        // $data->photos = [];

    }
}
