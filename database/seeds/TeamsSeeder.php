<?php

use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'app/developer_docs/team-seeder.sql';
        DB::unprepared(file_get_contents($path));
    }
}
