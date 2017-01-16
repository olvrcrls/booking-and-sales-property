<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_types', function (Blueprint $table) {
            $table->increments('payment_type_id');
            $table->string('payment_type_name',255)->unique();
            $table->boolean('payment_type_active')->default(true);
            $table->integer('created_by')->unsigned()->index();
            $table->integer('modified_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('user_id')->on('users');
            $table->foreign('modified_by')->references('user_id')->on('users');
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
        Schema::dropIfExists('payment_types');
    }
}
