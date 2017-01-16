<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_types', function (Blueprint $table) {
            $table->increments('feature_type_id');
            $table->string('feature_type_name', 255)->unique();
            $table->text('feature_type_description');
            $table->boolean('feature_type_active')->default(true);
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('modified_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('user_id')->on('users');
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
        Schema::dropIfExists('feature_types');
    }
}
