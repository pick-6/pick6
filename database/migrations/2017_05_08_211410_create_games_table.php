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
			$table->integer('home')->unsigned();
			$table->integer('away')->unsigned();
			$table->integer('home_score')->nullable();
			$table->integer('away_score')->nullable();
			$table->decimal('pick_cost', 8, 2);->default(2.00);
			$table->foreign('home')->references('id')->on('teams');
			$table->foreign('away')->references('id')->on('teams');
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
