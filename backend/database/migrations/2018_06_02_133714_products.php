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

                $table->string('district');                              //: "Theater District",
                $table->string('city');                                  //: "New York City",
                $table->string('website');                               //: "http://daoduythanh.com",
                $table->string('phone');                                 //: "+84988888888",
                $table->string('address');                               //: "231W 46th street, New York",

                $table->integer('num_reviews');                           //: 30,
                $table->integer('num_photos');                            //: 32,
                $table->integer('num_bookmarks');                         //: 27,
                $table->integer('num_check_in');                          //: 1316,
                $table->integer('num_votes');                             //: 232,
                $table->integer('cost');                                  //: 20,
                $table->integer('accepted_card');                         //: 1,
                $table->integer('accepted_cash');                         //: 1,

                $table->float('rating');                                  //: 4.1,

                $table->boolean('bookmarked');                            //: false,
                
                $table->string('latitude');                              
                $table->string('longitude');                             
 
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
