<?php

use Illuminate\Database\Seeder;

class SeasonTypesSeeder extends Seeder
{
    public function run()
    {
 		$this->seasonTypes();
    }

    protected function seasonTypes()
    {
        $path = 'app/developer_docs/season_types.sql';
        DB::unprepared(file_get_contents($path));
    }
}
