<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('operator_id')->unsigned();
            $table->string('operation', 128);
            $table->integer('amount');
            $table->string('note',255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bank_id')
                  ->references('id')
                  ->on('banks')
                  ->onUpdate('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade');

            $table->foreign('operator_id')
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
        Schema::dropIfExists('transactions');
    }
}
