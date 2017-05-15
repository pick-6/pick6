<?php

use Illuminate\Database\Seeder;

class CharitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'app/developer_docs/charities-seeder.sql';
        DB::unprepared(file_get_contents($path));
    }
}
