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

    public static function isWinner($id) {
	    $theGameForThisSelection = Games::find($id);	
	    // if ($this->score_selection == $theGameForThisSelection->getWinningScore()) {
	    // 	return true;
	    // }	else {
	    // 	return false;
	    // }
	    return false;
	}
}