<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoldtracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goldtracks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('booking_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('event_id');
            $table->integer('amount');
            $table->tinyInteger('code');
            $table->boolean('verified');
            $table->string('verified_by', 50);
            $table->dateTime('verified_at')->nullable();;
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('booking_id')
                  ->references('id')
                  ->on('bookings')
                  ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
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
        Schema::dropIfExists('goldtracks');
    }
}
