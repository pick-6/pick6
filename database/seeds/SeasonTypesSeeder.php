<?php

use Illuminate\Database\Seeder;

class SeasonTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('season_types')->insertGetId(
            ['type' => 'pre'],
            ['type' => 'reg'],
            ['type' => 'post'],
        );
    }
}
