<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = "games";

    public $timestamps = false;

    public static function getWinningScore() {
    	
    	$homeScore = strval($this->home_score);
    	$awayScore = strval($this->away_score);

    	$homeScoreArray = str_split($homeScore);
    	$homeScoreDigit = array_pop($homeScoreArray);

    	$awayScoreArray = str_split($awayScore);
    	$awayScoreDigit = array_pop($awayScoreArray);

    	$winningScore = intval($homeScoreDigit . $awayScoreDigit);

    	return $winningScore;
    }

    public static function getUserMoneyToDonate() {

        $theWinningCombination = 12;

        // $theWinningCombination = Selections::iswinner(); 

        if ($theWinningCombination) {
            
        $totalProceeds = Selections::where('game_id', '=', 1)->sum('amount');
        
        return $totalProceeds;
        
        }
    }

        public static function totalDonationPerGame($id) {
            
        $totalProceeds = Selections::where('game_id', '=', $id)->sum('amount');
        
        return $totalProceeds;
        
    }

    public static function totalUserDonationPerGame($id) {

        $user = \Auth::user()->id;
            
        $totalProceeds = Selections::where('user_id', '=', $user)->where('game_id', '=', $id)->sum('amount');
        
        return $totalProceeds;
        
    }

}
