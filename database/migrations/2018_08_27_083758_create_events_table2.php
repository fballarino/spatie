<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference', 30);
            $table->tinyInteger('buyers')->unsigned()->nullable(false);
            $table->tinyInteger('boosters')->unsigned()->nullable(false);
            $table->tinyInteger('buyers_booked')->unsigned()->nullable();
            $table->tinyInteger('boosters_booked')->unsigned()->nullable();
            $table->boolean('overbooking')->nullable(false);
            $table->integer('pot')->unsigned();
            $table->integer('leader_cut')->unsigned()->nullable();
            $table->dateTime('run_at')->nullable();
            $table->dateTime('visible_at')->nullable();
            $table->text('note')->nullable();
            $table->string('status',20);
            $table->integer('user_id')->unsigned()->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('events');
    }
}

