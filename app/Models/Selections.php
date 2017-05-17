<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selections extends Model
{
    protected $table = 'selections';
    public $timestamps = false;

	public function game () {
	    return $this->belongsTo('App\Models\Games');
		}

    public function isWinner() {
	    $theGameForThisSelection = Games::find($this->game_id);	
	    if ($this->score_selection == $theGameForThisSelection->getWinningScore()) {
	    	return true;
	    }	else {
	    	return false;
	    }
	}
}