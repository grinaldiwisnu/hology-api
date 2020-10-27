<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy', function (Blueprint $table) {
            $table->smallIncrements('academy_id');
            $table->unsignedSmallInteger('user_id');
            $table->unsignedSmallInteger('academy_resume');
            $table->string('academy_payment_proof', 45);
            $table->smallInteger('academy_status');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academy');
    }
}
