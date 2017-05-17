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
            if ($game->id == 17) {
                break;
            }
			$game->winning_charity = rand(1, 100);
			$game->winning_user = rand(1, 10);
			$game->winning_total = rand(6, 2000);
			$game->save();
		}

    }

}
