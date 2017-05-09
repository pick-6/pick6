<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBetsTable extends Migration
{
    public function up()
    {
        Schema::create('user_bets', function (Blueprint $user_bets) {
        $user_bets->integer('user_id'); 
        $user_bets->integer('game_id');
        $user_bets->integer('gross_receipts');
        $user_bets->foreign('user_id')->references('user_id')->on('games');
        $user_bets->foreign('game_id')->references('game_id')->on('games');
        });       
    }


    public function down()
    {
        Schema::dropIfExists('user_bets');
    }
}
