<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attendance_id');
            $table->string('code', 20);
            $table->string('title', 100);
            $table->text('description');
            $table->tinyInteger('status')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('attendance_id')
                ->references('id')
                ->on('attendances')
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
        Schema::dropIfExists('tickets');
    }
}
