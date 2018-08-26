<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
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
            $table->string('product_name', 50);
            $table->string('difficulty',20);
            $table->string('reference', 30);
            $table->tinyInteger('buyers')->unsigned()->nullable(false);
            $table->tinyInteger('boosters')->unsigned()->nullable(false);
            $table->boolean('overbooking')->nullable(false);
            $table->integer('pot')->unsigned();
            $table->dateTime('run_at')->nullable();
            $table->dateTime('visible_at')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
