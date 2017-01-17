<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitationBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitation_bookings', function (Blueprint $table) {
            $table->increments('visitation_booking_id');
            $table->date('visitation_booking_date');
            $table->time('visitation_booking_time');
            $table->integer('visitation_booking_client_id')->unsigned()->index();
            $table->foreign('visitation_booking_client_id')->references('client_id')->on('clients');
            $table->integer('visitation_booking_property_id')->unsigned()->index();
            $table->foreign('visitation_booking_property_id')->references('property_id')->on('properties');
            $table->boolean('visitation_booking_cancelled')->default(false);
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_date')->nullable();
            $table->integer('modified_by')->unsigned()->index();
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
        Schema::dropIfExists('visitation_bookings');
    }
}
