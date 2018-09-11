<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'favorite_categories',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('id_category')
                    ->index()
                    ->nullable(false);
                $table->string('id_user')
                    ->index()
                    ->nullable(false);
                $table->timestamps();
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
        Schema::dropIfExists('favorite_categories');
    }
}
