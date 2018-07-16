<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Selections;
use App\Models\Games;
use App\User;

class SelectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkPickExists($pick, $gameId)
    {
        $findPick = Selections::select('id')->where('game_id', '=', $gameId)->where('square_selection', '=', $pick)->get();
        $pickExists = count($findPick) > 0;
        if ($pickExists) {
            return true;
        } else {
            return false;
        }
    }

    public function store(Request $request)
    {
        $userId = \Auth::id();
        $gameId = $request->game_id;

        $validPicks = 0;
        foreach ($request->selection as $selection) {
            if ($this->checkPickExists($selection, $gameId)) {
                continue;
            }
            $selections = new Selections();
            $selections->user_id = $userId;
            $selections->game_id = $gameId;
            $selections->square_selection = $selection;
            $selections->save();
            $validPicks++;
        }

        // update credit balance
        $getCost = Games::select('pick_cost')->where('id', '=', $gameId)->get();
        $pickCost = $getCost[0]['pick_cost'];
        $getUserCredit = User::select('credit')->where('id', '=', $userId)->get();
        $userCredit = $getUserCredit[0]['credit'];
        $costOfPicks = $validPicks * $pickCost;
        $updatedCreditAmount = $userCredit - $costOfPicks;

        $user = User::find($userId);
        $user->credit = $updatedCreditAmount;
        $user->save();

        $request->session()->flash('successMessage', 'Thanks for playing! You may pick more squares if you\'d like.');
        return redirect()->action('GamesController@show', $gameId);
    }

    public function destroy(Request $request)
    {
        $user = \Auth::user();
        $userId = $user->id;
        $gameId = $request->game_id;
        $selection = $request->selection;

        $selections = Selections::select('id')
        ->where('square_selection', '=', $selection)
        ->where('game_id', '=', $gameId)
        ->where('user_id', '=', $userId)
        ->get();

        if (count($selections) != 1) {
            $request->session()->flash('errorMessage', 'Oops, failed to delete pick.');
            return redirect()->action('GamesController@show', $gameId);
        } else {
            $pick = Selections::select('id')
            ->where('square_selection', '=', $selection)
            ->where('game_id', '=', $gameId)
            ->where('user_id', '=', $userId);
            $pick->delete();
        }

        // update credit balance
        $getCost = Games::select('pick_cost')->where('id', '=', $gameId)->get();
        $pickCost = $getCost[0]['pick_cost'];
        $getUserCredit = User::select('credit')->where('id', '=', $userId)->get();
        $userCredit = $getUserCredit[0]['credit'];
        $updatedCreditAmount = $userCredit + $pickCost;

        $user = User::find($userId);
        $user->credit = $updatedCreditAmount;
        $user->save();

        $request->session()->flash('successMessage', 'Your pick was deleted successfully!');

        return redirect()->action('GamesController@show', $gameId);

    }
}
