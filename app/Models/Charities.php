<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charities extends Model
{
	
	protected $table = 'charities';
    public $timestamps = false;

    public static function getMoney () {	    
	
	    $theCharityForThisSelection = Charity::find($this->charities_id);
    
      $moneyToBeReceived = Games::getUserMoneyToDonate(); 

    	}

  }

  	public static function assignMoney (){

  		$moneyToAssign = $this->getMoney();
  		
  		$charityToReceive = \App\Models\Charity::find($this->charities_id);

		$charityToReceive->gross_receipts = $moneyToAssign;

  	}
}
