<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertySalesTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_sales_transactions', function (Blueprint $table) {
            $table->increments('property_sales_transaction_id');
            $table->integer('property_sales_client')->unsigned()->index();
            $table->foreign('property_sales_client')->references('client_id')->on('clients');
            $table->decimal('property_sales_transaction_price', 15, 2)->unsigned();
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
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
        Schema::dropIfExists('property_sales_transactions');
    }
}
