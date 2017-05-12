<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selections extends Model
{
    protected $table = 'selections';
    public $timestamps = false;

    public function isWinner() {
	    $theGameForThisSelection = Game::find($this->game_id);	
	    if ($this->score_selection == $theGameForThisSelection->getWinningScore() {
	    	return true;
	    }	else {
	    	return false;
	    }
	}
}