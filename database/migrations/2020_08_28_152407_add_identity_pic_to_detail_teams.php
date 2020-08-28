<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdentityPicToDetailTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_teams', function (Blueprint $table) {
            $table->string('detail_team_identity_pic', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_teams', function (Blueprint $table) {
            $table->dropColumn('detail_team_identity_pic');
        });
    }
}
