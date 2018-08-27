<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();                   // FK on events table
            $table->string('buyer_name',20);
            $table->string('buyer_realm',30);
            $table->string('buyer_btag',30)->nullable(true);
            $table->string('class',15)->nullable(true);
            $table->string('buyer_spec',20)->nullable(true);
            $table->tinyInteger('buyer_boosters')->nullable(true);
            $table->integer('user_id')->unsigned();
            $table->integer('collector_id')->unsigned()->nullable(true); // FK on users table
            $table->integer('price');
            $table->integer('fee')->nullable(true);
            $table->boolean('fpaid')->nullable(true);
            $table->text('note')->nullable(true);
            $table->string('status',10)->nullable(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onUpdate('cascade');

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
        Schema::dropIfExists('bookings');
    }
}
