<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBetsTable extends Migration
{
    public function up()
    {
        Schema::create('user_bets', function (Blueprint $user_bets) {
        $user_bets->integer('user_id')->unsigned(); 
        $user_bets->integer('game_id')->unsigned();
        $user_bets->integer('bet_total');
        $user_bets->foreign('user_id')->references('id')->on('games');
        $user_bets->foreign('game_id')->references('id')->on('games');
        });       
    }


    public function down()
    {
        Schema::dropIfExists('user_bets');
    }
}
