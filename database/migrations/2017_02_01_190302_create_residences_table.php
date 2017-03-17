<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('category');
            $table->string('type');
            $table->string('street_adress');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->float('price', 8, 2); //change to integer
            $table->string('price_range');
            $table->string('area', 8, 2); //change to integer
            $table->string('area_range');
            $table->float('construction_area', 8, 2); //change to integer
            $table->string('construction_area_range');
            $table->boolean('is_direct');
            $table->string('number_of_rooms');
            $table->string('number_of_bathrooms');
            $table->string('parking_spots');
            $table->boolean('has_garden');
            $table->boolean('has_pool');
            $table->boolean('is_used');
            $table->boolean('pet_friendly');
            $table->boolean('laundry');
            $table->boolean('utilities_included');
            $table->boolean('furniture_included');
            $table->boolean('wifi_included');
            $table->boolean('is_reported')->default(0);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residences');
    }
}
