<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winnings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('game_id')->unsigned()->nullable();
            $table->integer('winning_selection')->nullable();
            $table->integer('winning_user')->unsigned()->nullable();
            $table->decimal('winning_total', 7, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('winnings');
    }
}
