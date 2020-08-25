<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->smallIncrements('user_id');
            $table->unsignedSmallInteger('institution_id');
            $table->string('user_fullname', 60);
            $table->string('user_email', 60);
            $table->string('user_name', 45);
            $table->text('user_password');
            $table->char('user_gender', 1);
            $table->date('user_birthdate', 1);
            $table->foreign('institution_id')->references('institution_id')->on('institutions');
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
        Schema::dropIfExists('users');
    }
}
