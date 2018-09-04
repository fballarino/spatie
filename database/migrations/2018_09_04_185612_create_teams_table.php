<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name',128);
            $table->unsignedInteger('article_id');
            $table->tinyInteger('tank');
            $table->tinyInteger('healer');
            $table->tinyInteger('mdps');
            $table->tinyInteger('rdps');
            $table->string('description',255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
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
        Schema::dropIfExists('teams');
    }
}
