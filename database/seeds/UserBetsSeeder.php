<?php

use Illuminate\Database\Seeder;

class UserBetsSeeder extends Seeder
{
    public function run()
    {
        $this->fakeUserBets();
    }
    
    protected function fakeUserBets()
    {
        $user_bets = new \App\User();
        $user_bets->user_id;
        $user_bets->game_id;
        $user_bets->gross_receipts = '6';
        $user_bets->save();
    }
}
