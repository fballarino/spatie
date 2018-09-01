<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('character_id');
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('signup_id');
            $table->unsignedInteger('cut')->nullable();
            $table->unsignedInteger('leader_cut')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade');

            $table->foreign('character_id')
                  ->references('id')
                  ->on('characters')
                  ->onUpdate('cascade');

            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onUpdate('cascade');

            $table->foreign('signup_id')
                  ->references('id')
                  ->on('signups')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
