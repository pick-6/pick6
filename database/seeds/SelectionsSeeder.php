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
        for ($i=0; $i < 500; $i++) {
            $selections1 = new App\Models\Selections();
            $selections1->user_id = rand(1, 10);
            $selections1->game_id = rand(17, 48);
            $selections1->amount = 6;
            $selections1->square_selection = rand(0, 99);
            $selections1->save();
        }
    }
}
