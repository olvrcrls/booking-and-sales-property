<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestmonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testmonials', function (Blueprint $table) {
            $table->increments('testimonial_id');
            $table->string('testimonial_title', 200);
            $table->text('testimonial_content');
            $table->integer('testmonial_user')->unsigned()->index()->nullable();
            $table->foreign('testimonial_user')->references('user_id')->on('users');
            $table->boolean('testimonial_active')->default(true);
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified_date')->nullable();
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
        Schema::dropIfExists('testmonials');
    }
}
