<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_name');
            $table->timestamps();

            $table->unsignedBigInteger('travel_id');

            $table->foreign('travel_id')->references('id')->on('travels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_visit');
    }
}
