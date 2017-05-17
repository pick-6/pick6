<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Games;
use App\Models\Selections;
use App\User;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::get();
        return view('playGame')->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $games = new Game();
        // $games->home = $request->home;
        // $games->away = $request->away;
        // $games->home_score = $request->home_score;
        // $games->away_score = $request->away_score;
        
        // $games->save();
        // $request->session()->flash('successMessage', 'Post saved successfully');
        
        // return redirect()->action('gamessController@show', $games->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $game = Games::find($id);

        $thisGameSelections = [];

        // SELECT users.username FROM users JOIN games ON users.id = games.winning_user
        $winningSelection = User::select('username')->join('games', 'users.id', '=', 'games.winning_user');

        $squaresSelected = Selections::where('game_id', '=', $id)->get();
        foreach ($squaresSelected as $squareSelected) {
            $thisGameSelections[] =  "$squareSelected->square_selection";
        }

        if(!$game) {
            abort(404);
        }
        
        return view('showGame')->with(compact('game', 'thisGameSelections', 'winningSelection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate  \Http\Response
     */
    public function edit($id)
    {
        // $games = Game::find($id);
        
        // if(!$games) {
        //     Session::flash("errorMessage", "Game not found");
        // }
        // return view('games.edit')->with('games', $games);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $games = Game::find($id);
        
        // if(!$games) {
        //     Session::flash("errorMessage", "games not found");
        //     return redirect()->action("GamesController@index");
        // }
        
        // $games->home = $request->home;
        // $games->away = $request->away;
        // $games->home_score = $request->home_score;
        // $games->away_score = $request->away_score;
        
        // $games->save();
        // return view('games.show')->with('games', $games);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $games = Game::find($id);
       //  if(!$games) {
       //      Session::flash('errorMessage', "Post not found");
       //      return redirect()->action('GamesController@index');
       //  }
       //  $games->delete();
       //  return redirect()->action('GamesController@index');
    }
}
