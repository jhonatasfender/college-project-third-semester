<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisteredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'registereds',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('name')
                    ->index()
                    ->nullable(false)
                    ->unique();

                $table->string('email')
                    ->index()
                    ->nullable(false)
                    ->unique();

                $table->string('address')
                    ->index()
                    ->nullable(false);

                $table->string('password');
                $table->rememberToken();

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
        Schema::dropIfExists('registereds');
    }
}
