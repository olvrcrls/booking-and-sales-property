<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_photos', function (Blueprint $table) {
            $table->increments('property_photo_id');
            $table->text('file_path'); // from/to/file.jpg
            $table->integer('property_photo_property_id')->unsigned()->index();
            $table->foreign('property_photo_property_id')->references('property_id')->on('properties');
            $table->text('property_photo_description');
            // $table->boolean('property_photo_active')->default(true); the picture file is directly deleted to save space / otherwise uncomment.
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
        Schema::dropIfExists('property_photos');
    }
}
