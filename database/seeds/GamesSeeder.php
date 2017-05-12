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
        $games = new App\Models\Games();
        $games->home = 'New York Jets';
        $games->away = 'Buffalo Bills';
        $games->home_score = '21';
        $games->away_score = '7';
        $games->winning_selection = '17';
        $games->save();

        $games2 = new App\Models\Games();
        $games2->home = 'Pittsburgh Steelers';
        $games2->away = 'Cleveland Browns';
        $games2->home_score = '3';
        $games2->away_score = '10';
        $games2->winning_selection = '30';
        $games2->save();

        $games3 = new App\Models\Games();
        $games3->home = 'Tampa Bay Buccaneers';
        $games3->away = 'Miami Dolphins';
        $games3->home_score = '10';
        $games3->away_score = '17';
        $games3->winning_selection = '07';
        $games3->save();

        $games4 = new App\Models\Games();
        $games4->home = 'Oakland Raiders';
        $games4->away = 'Tennessee Titans';
        $games4->home_score = '7';
        $games4->away_score = '14';
        $games4->winning_selection = '74';
        $games4->save();

        $games5 = new App\Models\Games();
        $games5->home = 'Philadelphia Eagles';
        $games5->away = 'Washington Redskins';
        $games5->home_score = '28';
        $games5->away_score = '35';
        $games5->winning_selection = '85';
        $games5->save();

        $games6 = new App\Models\Games();
        $games6->home = 'Carolina Panthers';
        $games6->away = 'San Francisco 49ers';
        $games6->home_score = '52';
        $games6->away_score = '10';
        $games6->winning_selection = '20';
        $games6->save();

        $games7 = new App\Models\Games();
        $games7->home = 'New York Giants';
        $games7->away = 'Dallas Cowboys';
        $games7->home_score = '35';
        $games7->away_score = '28';
        $games7->winning_selection = '58';
        $games7->save();

        $games8 = new App\Models\Games();
        $games8->home = 'Jacksonville Jaguars';
        $games8->away = 'Houston Texans';
        $games8->home_score = '3';
        $games8->away_score = '7';
        $games8->winning_selection = '37';
        $games8->save();

        $games9 = new App\Models\Games();
        $games9->home = 'Arizona Cardinals';
        $games9->away = 'Detroit Lions';
        $games9->home_score = '21';
        $games9->away_score = '28';
        $games9->winning_selection = '18';
        $games9->save();

        $games10 = new App\Models\Games();
        $games10->home = 'Atlanta Falcons';
        $games10->away = 'Chicago Bears';
        $games10->home_score = '21';
        $games10->away_score = '17';
        $games10->winning_selection = '17';
        $games10->save();

        $games11 = new App\Models\Games();
        $games11->home = 'Baltimore Ravens';
        $games11->away = 'Cincinnati Bengals';
        $games11->home_score = '24';
        $games11->away_score = '12';
        $games11->winning_selection = '42';
        $games11->save();

        $games12 = new App\Models\Games();
        $games12->home = 'Indianapolis Colts';
        $games12->away = 'St. Louis Rams';
        $games12->home_score = '42';
        $games12->away_score = '49';
        $games12->winning_selection = '29';
        $games12->save();

        $games13 = new App\Models\Games();
        $games13->home = 'Seattle Seahawks';
        $games13->away = 'Green Bay Packers';
        $games13->home_score = '13';
        $games13->away_score = '17';
        $games13->winning_selection = '37';
        $games13->save();

        $games14 = new App\Models\Games();
        $games14->home = 'New Orleans Saints';
        $games14->away = 'Minnesota Vikings';
        $games14->home_score = '25';
        $games14->away_score = '7';
        $games14->winning_selection = '57';
        $games14->save();

        $games15 = new App\Models\Games();
        $games15->home = 'San Diego Chargers';
        $games15->away = 'Denver Broncos';
        $games15->home_score = '13';
        $games15->away_score = '7';
        $games15->winning_selection = '37';
        $games15->save();

    }
}
