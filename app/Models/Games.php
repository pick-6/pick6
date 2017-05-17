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

    public static function totalDonationPerGame($id) {
            
        $totalProceeds = Selections::where('game_id', '=', $id)->sum('amount');
        
        return $totalProceeds;
        
    }
}
