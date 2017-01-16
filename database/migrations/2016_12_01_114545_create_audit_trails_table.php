<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->increments('audit_id');
            $table->text('audit_action');
            $table->integer('audit_user')->unsigned()->index();
            $table->foreign('audit_user')->references('user_id')->on('users');
            $table->datetime('audit_datetime')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_trails');
    }
}
