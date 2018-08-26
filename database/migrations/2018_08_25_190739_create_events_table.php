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
            $table->integer('product_id')->unsigned()->notnullable();
            $table->string('difficulty',20);
            $table->string('reference', 20);
            $table->tinyInteger('buyers')->unsigned()->nullable(false);
            $table->tinyInteger('boosters')->unsigned()->nullable(false);
            $table->boolean('overbooking')->nullable(false);
            $table->integer('pot')->unsigned();
            $table->dateTime('run_at')->nullable();
            $table->dateTime('visible_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('product_id')
                  ->on('products')
                  ->references('id')
                  ->onDelete('cascade')
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
