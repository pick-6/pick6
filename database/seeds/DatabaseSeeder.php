<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('charities')->delete();
        DB::table('users')->delete();
        DB::table('teams')->delete();
        DB::table('games')->delete();
        DB::table('selections')->delete();

        $this->call('CharitiesSeeder');
        $this->call('UsersSeeder');
        $this->call('TeamsSeeder');
        $this->call('GamesSeeder');
        $this->call('SelectionsSeeder');

        Model::reguard();
    }
}
