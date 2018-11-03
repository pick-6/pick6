<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Selections;
use App\Models\Games;
use App\User;
use DB;

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
        $picks = count($request->selection)  > 1 ? "picks were" : "pick was";

        $user = User::find($userId);
        $user->credit = $updatedCreditAmount;
        $user->save();

        // $request->session()->flash('successMessage', 'Thanks for playing! You may pick more squares if you\'d like.');
        // return redirect()->action('GamesController@show', $gameId);
        // return redirect($_SERVER['HTTP_REFERER']);
        $response = response()->json(['success' => true, 'msg' => "Your $picks saved. Good luck!", 'game' => $gameId]);
        return $response;
    }

    public function destroy(Request $request)
    {
        try
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
                $response = response()->json([
                    'success' => false,
                    'msg' => "Oops, we failed to delete your pick.",
                    'game' => $gameId
                ]);
                return $response;
            } else {
                $selections = Selections::select('id')
                ->where('square_selection', '=', $selection)
                ->where('game_id', '=', $gameId)
                ->where('user_id', '=', $userId);
                $selections->delete();
            }

            // update credit balance
            $getCost = Games::select('pick_cost')->where('id', '=', $gameId)->get(); // todo: update to get cost from request
            $pickCost = $getCost[0]['pick_cost'];
            $getUserCredit = User::select('credit')->where('id', '=', $userId)->get();
            $userCredit = $getUserCredit[0]['credit'];
            $updatedCreditAmount = $userCredit + $pickCost;

            $user = User::find($userId);
            $user->credit = $updatedCreditAmount;
            $user->save();

            $response = response()->json([
                'success' => true,
                'msg' => "Your pick was deleted successfully!",
                'game' => $gameId
            ]);
        }
        catch (\Exception $e)
        {
            $response = response()->json([
                'success' => false,
                'msg' => $e->getMessage().
                        '<br />'.$e->getFile().
                        '<br /> Line: '.$e->getLine()
            ]);
        }

        return $response;
    }

    public function gameCancelled(Request $request, $gameId)
    {
        try
        {
            $selections = Selections::select('selections.id', 'selections.user_id', 'games.pick_cost')
            ->join('games', 'games.id', '=', 'selections.game_id')
            ->where('selections.game_id', '=', $gameId)
            ->get();

            if (count($selections) > 0) {
                foreach ($selections as $selection) {
                    $id = $selection['id'];
                    $userId = $selection['user_id'];
                    $cost = $selection['pick_cost'];

                    $selection->delete();

                    $getUserCredit = User::select('credit')->where('id', '=', $userId)->get();
                    $userCredit = $getUserCredit[0]['credit'];
                    $updatedCreditAmount = $userCredit + $cost;

                    $user = User::find($userId);
                    $user->credit = $updatedCreditAmount;
                    $user->save();
                }
            }
            // $teams = Games::select("games.home_team", "games.away_team")->where("id", "=", $gameId)->get();
            $teams = Games::select(DB::raw('home_team.name as home, away_team.name as away'))
            ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
            ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
            ->where("games.id", "=", $gameId)
            ->get();
            $homeTeam = $teams[0]['home'];
            $awayTeam = $teams[0]['away'];

            $response = response()->json([
                'success' => false, // set to false to have red bkgd message
                'msg' => "Sorry, the $homeTeam vs. $awayTeam game was cancelled due to low user participation. <br /> All your picks, if any, have been refunded.",
                'duration' => 10000,
                'maxWidth' => 500,
            ]);
        }
        catch (\Exception $e)
        {
            $response = response()->json([
                'success' => false,
                'duration' => 1000000,
                'msg' => $e->getMessage()
                // 'msg' => $e->getMessage().$e->getCode().$e->getFile().$e->getLine().$e->getTraceAsString();
            ]);
        }

        return $response;
    }
}
