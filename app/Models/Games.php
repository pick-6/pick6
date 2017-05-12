<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = "games";

    public $timestamps = false;

    public function getWinningScore() {
    	
    	settype($this->away_score, 'string');
    	settype($this->home_score, 'string');

    	if ( === ) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
