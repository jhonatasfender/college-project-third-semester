<?php

use Illuminate\Database\Seeder;

class FavoriteCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorite_categories = factory(\App\Models\FavoriteCategories::class)
            ->times(10)->create();
    }
}
