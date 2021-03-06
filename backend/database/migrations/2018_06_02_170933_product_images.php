<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'product_images',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('file')
                    ->index()
                    ->nullable(false)
                    ->unique();

                $table->unsignedInteger('products_id')
                    ->nullable(false);

                $table->timestamps();

                $table->foreign('products_id')
                    ->references('id')
                    ->on('products');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
