<?php

use App\Models\Categories;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private const VALUE_INSERT = 2;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, self::VALUE_INSERT)->create()
            ->each(
                function ($users) {
                    factory(Categories::class, self::VALUE_INSERT)->create()
                        ->each(
                            function ($categories) {

                                factory(Products::class, self::VALUE_INSERT)->create(
                                    ['category_id' => $categories->id]
                                )
                                    ->each(
                                        function ($products) use (&$categories) {
                                            factory(ProductImages::class, self::VALUE_INSERT)->create(
                                                ['products_id' => $products->id]
                                            );
                                        }
                                    );
                            }
                        );
                }
            );

        User::all()->each(function ($user) {
            Categories::all()->each(function ($category) use ($user) {
                $category->users()->save($user);
            });
        });
    }
}
