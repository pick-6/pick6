<?php

use Illuminate\Database\Seeder;

class WinningsSeeder extends Seeder
{
    public function run()
    {
        $this->fakeWinnings();
    }

    protected function fakeWinnings()
    {
		for ($i = 1; $i <= 17; $i++) {
            $winnings = new \App\Models\Winnings();

            if ($winnings->id == 16) {
                $winnings->game_id = $i;
                $winnings->winning_charity = rand(1, 100);
    			$winnings->winning_user = 11;
    			$winnings->winning_total = rand(6, 2000);
    			$winnings->save();
                break;
            }

            $winnings->game_id = $i;
            $winnings->winning_charity = rand(1, 300);
            $winnings->winning_user = rand(1, 11);
			$winnings->winning_total = rand(6, 2000);
			$winnings->save();
		}
    }
}
