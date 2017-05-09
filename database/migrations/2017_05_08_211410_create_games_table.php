<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('home');
			$table->string('away');
			$table->integer('home_score');
			$table->integer('away_score');
			$table->integer('winning_selection')->unsigned();
			// $table->foreign('winning_selection')->references('id')->on('selections');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('games');
	}
}
