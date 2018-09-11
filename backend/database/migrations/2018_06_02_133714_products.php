<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'products',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('name')
                    ->index()
                    ->nullable(false)
                    ->unique();

                $table->text('description')
                    ->nullable(false);

                $table->float('price', 8, 2)
                    ->nullable(false);

                $table->dateTime('expiration_date')
                    ->nullable(false);

                $table->unsignedInteger('category_id')
                    ->nullable(false);

                $table->timestamps();

                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories');
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
        Schema::dropIfExists('products');
    }
}
