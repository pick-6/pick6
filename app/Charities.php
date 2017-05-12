<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charities extends Model
{
	
	protected $table = 'charities';
    public $timestamps = false;

    public function getMoney () {	    
	
	    $theCharityForThisSelection = Charity::find($this->charities_id);
    
    	$theWinningCombination = Selections::iswinner(); 

    	if ($theWinningCombination) {
    		
    		$totalProceeds = Selection::where('game_id', "=", $gameId)->sum('amount');
    		
    		return $totalProceeds;

    	}
  	}

  	public function assignMoney (){

  		$moneyToAssign = $this->getMoney();
  		
  		$charityToReceive = \App\Models\Charities::find($this->charities_id);

		$charityToReceive->gross_receipts = $moneyToAssign;

  	}
}
