<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_teams', function (Blueprint $table) {
            $table->smallIncrements('detail_team_id');
            $table->unsignedSmallInteger('user_id');
            $table->unsignedSmallInteger('team_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('team_id')->references('team_id')->on('teams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_teams');
    }
}
