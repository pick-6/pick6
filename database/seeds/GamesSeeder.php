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
    }

}
