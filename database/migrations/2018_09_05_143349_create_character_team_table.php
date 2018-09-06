<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_team', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('user_id');
            $table->string('part',64);
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
        Schema::table('character_team', function (Blueprint $table) {
            //
        });
    }
}
