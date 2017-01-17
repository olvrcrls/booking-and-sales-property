<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('client_id');
            $table->string('client_firstname',150);
            $table->string('client_middlename',150)->nullable();
            $table->string('client_lastname',150);
            $table->string('client_email');
            $table->string('client_contact_number',20);
            $table->integer('client_user')->unsigned()->index();
            $table->foreign('client_user')->references('user_id')->on('users');
            $table->text('client_message')->nullable();
            $table->datetime('created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('clients');
    }
}
