<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = "games";

    public $timestamps = false;

    public function getWinningScore() {
    	
    	$homeScore = settype($this->home_score, 'string');
    	$awayScore = settype($this->away_score, 'string');

    	$homeScoreArray = str_split($homeScore);
    	$homeScoreDigit = array_pop($homeScoreArray);

    	$awayScoreArray = str_split($awayScore);
    	$awayScoreDigit = array_pop($awayScoreArray);

    	$winningScore = intval($homeScoreDigit . $awayScoreDigit);

    	// if ( === ) {
    	// 	return true;
    	// } else {
    	// 	return false;
    	// }
    }
}
