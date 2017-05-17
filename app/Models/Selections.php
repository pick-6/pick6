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

    public static function isWinner($id, $selection) {
	    $theGameForThisSelection = Games::find($id);	
	    if ($selection == $theGameForThisSelection->winning_selection) {
	    	return true;
		}
	}
}