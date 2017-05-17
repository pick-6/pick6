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
			$table->date('date_for_week');
			$table->time('time');
			$table->integer('week');
			$table->string('home');
			$table->string('away');
			$table->integer('home_score')->nullable();
			$table->integer('away_score')->nullable();
			$table->integer('winning_selection')->nullable();
			$table->string('winning_charity')->nullable();
			$table->integer('winning_user')->nullable();
			$table->decimal('winning_total', 5, 2)->nullable();
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
