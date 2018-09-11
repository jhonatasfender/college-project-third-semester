<?php

use Illuminate\Database\Seeder;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_images = factory(\App\Models\ProductImages::class)
            ->times(10)->create();
    }
}
