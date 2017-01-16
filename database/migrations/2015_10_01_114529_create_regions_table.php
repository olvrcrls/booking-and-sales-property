<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('region_id');
            $table->string('region_name',255)->unique();
            $table->boolean('region_active')->default(true);
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
        Schema::dropIfExists('regions');
    }
}
