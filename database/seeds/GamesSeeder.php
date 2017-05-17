<?php

use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    public function run()
    {
 		$this->fakeGames();
    }

    protected function fakeGames()
    {

        $path = 'app/developer_docs/games.sql';
        DB::unprepared(file_get_contents($path));
		$games = \App\Models\Games::all();

		foreach ($games as $game) {
			$game->winning_charity = 'United Way';
			$game->winning_user = 2;
			$game->winning_total = 25;
			$game->save();
		}

    }

}
