<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->bigIncrements('feature_id');
            $table->string('feature_name',255);
            $table->integer('feature_type_id')->unsigned()->index();
            $table->foreign('feature_type_id')->references('feature_type_id')->on('feature_types');
            $table->text('feature_description');
            $table->boolean('feature_active')->default(true);
            $table->integer('feature_property_id')->unsigned()->index();
            $table->foreign('feature_property_id')->references('property_id')->on('properties');
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('modified_by')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('features');
    }
}
