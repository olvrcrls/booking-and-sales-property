<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->increments('booking_transaction_id');
            $table->decimal('booking_transaction_price',15,2)->unsigned();
            $table->integer('booking_transaction_reservation_id')->unsigned()->index();
            $table->foreign('booking_transaction_reservation_id')->references('booking_reservation_id')->on('booking_reservations');
            $table->integer('booking_transaction_client_id')->unsigned()->index();
            $table->foreign('booking_transaction_client_id')->references('client_id')->on('clients');
            $table->integer('booking_transaction_payment_method')->unsigned()->index();
            $table->foreign('booking_transaction_payment_method')->references('payment_method_id')->on('payment_methods');
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
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
        Schema::dropIfExists('booking_transactions');
    }
}
