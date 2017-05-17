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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('playGame');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selections = new Selections();
        $selections->user_id = $request->user_id;
        $selections->game_id = $request->game_id;
        $selections->amount = $request->amount;
        $selections->square_selection = intval(strval($request->hscore).strval($request->ascore));
        
        $selections->save();
        $request->session()->flash('successMessage', 'Thank you for your donation. Your square selection has been saved successfully. You may pick another square if you\'d like.');
        return redirect()->action('GamesController@show', $selections->game_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $games = Games::get();
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->get();
        return view('payment')->with(compact('user', 'gamesUserIsPlaying', 'games'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
