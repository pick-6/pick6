<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Games;
use App\Models\Selections;
use App\User;
use Auth;
use Image;

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

        // Games for the Week
        $dates = Games::groupBy('date_for_week')->get();

        // My Current Games
        $playingIn = [];
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->groupBy("game_id")->get();
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
        $count = count($gamesUserIsPlaying);

        // Last Week's Results


        // Leaderboard


        return view('account')->with(compact('user', 'gamesUserIsPlaying', 'games', 'count', 'dates', 'playingIn'));
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

    public function editPassword()
    {
        return view('editPassword');
    }

    public function updatePassword(Request $request)
    {
        $existingUser = User::find(\Auth::id());
        $existingUser->password = bcrypt($request->password);
        $existingUser->save();
        return redirect()->action('AccountController@index');
    }

    public function uploadProfilePic(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/img/profilePics/' . $filename ) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return redirect('/account');
    }

    public function destroy($id)
    {
        abort(404);
    }
}
