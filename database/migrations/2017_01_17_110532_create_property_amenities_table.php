<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_amenities', function (Blueprint $table) {
            $table->increments('property_amenity_id');
            $table->integer("property_amenity_amenity_id")->unsigned()->index();
            $table->foreign('property_amenity_amenity_id')->references('amenity_id')->on('amenities');
            $table->integer('property_amenity_property_id')->unsigned()->index();
            $table->foreign('property_amenity_property_id')->references('property_id')->on('properties');
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
            $table->integer('created_by')->unsigned()->index();
            $table->foreign('created_by')->references('user_id')->on('users');
            $table->integer('modified_by')->unsigned()->index()->nullable();
            $table->foreign('modified_by')->references('user_id')->on('users');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_amenities');
    }
}
