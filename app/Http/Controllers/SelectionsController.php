<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Selections;
use App\Models\Games;

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

    public function store(Request $request)
    {
        foreach ($request->selection as $selection) {
            $selections = new Selections();
            $selections->user_id = $request->user_id;
            $selections->game_id = $request->game_id;
            $selections->square_selection = $selection;
            $selections->save();
        }
        $request->session()->flash('successMessage', 'Thanks for playing! You may pick more squares if you\'d like.');
        return redirect()->action('GamesController@show', $selections->game_id);
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
