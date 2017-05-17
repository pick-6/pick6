<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Games;
use App\Models\Selections;
use App\User;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = \Auth::user();
        $games = Games::get();
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->get();
        return view('account')->with(compact('user', 'gamesUserIsPlaying', 'games'));
    }


    public function create()
    {
        abort(404);
    }


    public function store(Request $request)
    {
        abort(404);
    }


    public function show()
    {
        abort(404);
    }


    public function edit()
    {
        return view('edit');
    }


    public function update(Request $request)
    {
        $existingUser = User::find(\Auth::id());
        $existingUser->first_name = $request->first_name;
        $existingUser->last_name = $request->last_name;
        $existingUser->username = $request->username;
        $existingUser->email = $request->email;
        $existingUser->password = bcrypt($request->password);
        $existingUser->save();
        return redirect()->action('AccountController@index');
    }


    public function destroy($id)
    {
        abort(404);
    }
}
