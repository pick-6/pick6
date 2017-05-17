<?php

use Illuminate\Database\Seeder;

class SelectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->fakeSelections();
    }

    public function fakeSelections()
    {
    	$selections1 = new App\Models\Selections();
    	$selections1->user_id = 1;
    	$selections1->game_id = 1;
    	$selections1->amount = 6;
        $selections1->square_selection = 57;
        $selections1->save();
		
		$selections2 = new App\Models\Selections();
		$selections2->user_id = 2;
		$selections2->game_id = 1;
    	$selections2->amount = 6;
		$selections2->square_selection = 11;
		$selections2->save();

		$selections3 = new App\Models\Selections();
		$selections3->user_id = 3;
		$selections3->game_id = 1;
    	$selections3->amount = 6;    
		$selections3->square_selection = 34;
		$selections3->save();

		$selections4 = new App\Models\Selections();
		$selections4->user_id = 4;
		$selections4->game_id = 1;
    	$selections4->amount = 6;
    	$selections4->square_selection = 21;
		$selections4->save();

		$selections5 = new App\Models\Selections();
		$selections5->user_id = 5;
		$selections5->game_id = 1;    	
    	$selections5->amount = 6;
    	$selections5->square_selection = 33;
		$selections5->save();
    }
}
