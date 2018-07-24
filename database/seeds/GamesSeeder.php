<?php

use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    public function run()
    {
 		$this->games();
    }

    protected function games()
    {
        $path = 'app/developer_docs/games.sql';
        DB::unprepared(file_get_contents($path));
    }
}
