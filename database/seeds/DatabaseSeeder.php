<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        DB::table('users')->delete();
        DB::table('teams')->delete();
        DB::table('games')->delete();
        DB::table('winnings')->delete();
        DB::table('selections')->delete();
        DB::table('season_types')->delete();

        $this->call('UsersSeeder');
        $this->call('TeamsSeeder');
        $this->call('SeasonTypesSeeder');
        $this->call('GamesSeeder');
        // $this->call('WinningsSeeder');

        Model::reguard();
    }
}
