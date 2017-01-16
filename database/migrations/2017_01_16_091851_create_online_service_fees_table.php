<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineServiceFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_service_fees', function (Blueprint $table) {
            /**
            * This table will be the online service fee
            * to keep the owner of the site on maintaining
            * the web hosting fees and services.
            */
            $table->increments('online_service_fee_id');
            $table->decimal('online_service_fee_rate', 10 ,2)->unsigned();
            $table->boolean('online_service_fee_active')->default(true);
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
            $table->integer('created_by')->unsigned()->index();
            $table->foreign('created_by')->references('user_id')->on('users');
            $table->integer('modified_by')->unsigned()->index()->nullable();
            $table->foreign('modified_by')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_service_fees');
    }
}
