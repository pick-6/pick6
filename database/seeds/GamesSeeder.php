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
        $games = new \App\Game();
        $games->id = '1';
        $games->home = 'Dallas Cowboys';
        $games->away = 'Washington Redskins';
        $games->home_score = '21';
        $games->away_score = '7';
        $games->winning_selection = '17';
        $games->save();
    }
}
