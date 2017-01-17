<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_reviews', function (Blueprint $table) {
            $table->increments('property_review_id');
            $table->integer('property_review_rate')->unsigned()->default(0);
            $table->text('property_review_message')->nullable();
            $table->integer('property_review_property')->unsigned()->index();
            $table->foreign('property_review_property')->references('property_id')->on('properties');
            $table->integer('property_review_user')->unsigned()->index();
            $table->foreign('property_review_user')->references('user_id')->on('users');
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
        Schema::dropIfExists('property_reviews');
    }
}
