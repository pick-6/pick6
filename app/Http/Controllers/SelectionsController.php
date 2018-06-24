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

    public function index()
    {
        //
    }

    public function create()
    {
        return view('playGame');
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

        $selectionCount = 0;
        foreach ($request->selection as $selection) {
            if ($this->checkPickExists($selection, $gameId)) {
                continue;
            }
            $selections = new Selections();
            $selections->user_id = $userId;
            $selections->game_id = $gameId;
            $selections->square_selection = $selection;
            $selections->save();
            $selectionCount++;
        }

        // update credit balance
        $cost = Games::select('pick_cost')->where('id', '=', $gameId)->get();
        $pickCost =$cost[0]['pick_cost'];
        $creditForUser = User::select('credit')->where('id', '=', $userId)->get();
        $userCredit = $creditForUser[0]['credit'];
        $updateCreditAmount = $userCredit - ($selectionCount * $pickCost);

        $user = User::find($userId);
        $user->credit = $updateCreditAmount;
        $user->save();

        $request->session()->flash('successMessage', 'Thanks for playing! You may pick more squares if you\'d like.');
        return redirect()->action('GamesController@show', $gameId);
    }

    public function show($id)
    {
        $user = \Auth::user();
        $games = Games::get();
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->get();
        return view('payment')->with(compact('user', 'gamesUserIsPlaying', 'games'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $selections = Selection::find($id);

        if (!$selections) {
            Selection::error();
            abort(404);
        }

        $selections->delete();

        $request->session()->flash('successMessage', 'Selection deleted successfully');

        return view('playGame');

    }
}
