<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_reservations', function (Blueprint $table) {
            $table->increments('booking_reservation_id');
            $table->date('booking_reservation_check_in');
            $table->date('booking_reservation_check_out');
            $table->integer('booking_reservation_client_id')->unsigned()->index();
            $table->foreign('booking_reservation_client_id')->references('client_id')->on('clients');
            $table->integer('booking_reservation_property_id')->unsigned()->index();
            $table->foreign('booking_reservation_property_id')->references('property_id')->on('properties');
            $table->boolean('booking_reservation_cancelled')->default(false);
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
            $table->integer('modified_by')->nullable()->unsigned()->index();
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
        Schema::dropIfExists('booking_reservations');
    }
}
