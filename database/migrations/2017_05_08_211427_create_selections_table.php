<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('selections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('game_id')->unsigned();
			$table->decimal('amount', 5, 2);
			$table->integer('square_selection');
			$table->integer('charity_id')->unsigned();
			$table->foreign('charity_id')->references('id')->on('charities');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('game_id')->references('id')->on('games');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('selections');
	}
}
