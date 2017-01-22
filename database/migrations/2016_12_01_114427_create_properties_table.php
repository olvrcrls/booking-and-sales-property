<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('property_id');
            $table->string('property_name', 255)->unique();
            $table->integer('property_bath_capacity')->unsigned();
            $table->integer('property_garage_capacity')->unsigned();
            $table->integer('property_bed_capacity')->unsigned();
            $table->decimal('property_size', 15, 2);
            $table->decimal('property_price', 15, 2)->nullable(); // nullable for booking / renting properties
            $table->text('property_description');
            $table->boolean('property_is_sold')->default(false);
            $table->boolean('property_is_occupied')->default(false);
            $table->boolean('property_is_negotiable')->default(false);
            $table->boolean('property_active')->default(true);
            $table->text('property_address');
            $table->integer('property_status_id')->unsigned()->index();
            $table->foreign('property_status_id')->references('property_status_id')->on('property_statuses');
            $table->integer('property_type_id')->unsigned()->index();
            $table->foreign('property_type_id')->references('property_type_id')->on('property_types');
            $table->integer('property_city_id')->unsigned()->index();
            $table->foreign('property_city_id')->references('city_id')->on('cities');
            $table->datetime('created_date')->default(\DB::raw("CURRENT_TIMESTAMP"));
            $table->datetime('modified_date')->nullable();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('modified_by')->unsigned()->index()->nullable();
            $table->string('url_slug')->unique();
            $table->foreign('created_by')->references('user_id')->on('users');
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
        Schema::dropIfExists('properties');
    }
}
