<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->smallIncrements('team_id');
            $table->unsignedSmallInteger('institution_id');
            $table->unsignedSmallInteger('competition_id');
            $table->string('team_name', 45);
            $table->string('team_payment_proof', 45);
            $table->unsignedSmallInteger('team_lead');
            $table->smallInteger('team_status');
            $table->foreign('institution_id')->references('institution_id')->on('institutions');
            $table->foreign('competition_id')->references('competition_id')->on('competitions');
            $table->foreign('team_lead')->references('user_id')->on('users');
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
        Schema::dropIfExists('teams');
    }
}
