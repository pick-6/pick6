<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Games;
use App\Models\Winnings;
use App\Models\Selections;
use App\User;
use Auth;
use Image;
use DB;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function index()
    {
        $data=[];
        $user = User::select('*')->where('id', '=', Auth::id())->get();
        $data['id'] = $user[0]['id'];
        $data['first_name'] = $user[0]['first_name'];
        $data['last_name'] = $user[0]['last_name'];
        $data['username'] = $user[0]['username'];
        $data['email'] = $user[0]['email'];
        $data['avatar'] = $user[0]['avatar'];
        $currentGames = $this->getMyCurrentGames($this->currentWeek, Auth::id());
        $data['currentGames'] = $currentGames;
        $hasCurrentGames = count($currentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;
        $gamesUserIsPlaying = Selections::where('user_id', "=", Auth::id())->groupBy("game_id")->get();
        $data['gamesUserIsPlaying'] = $gamesUserIsPlaying;
        $playingIn = [];
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
        $data['playingIn'] = $playingIn;
        $data['isLoggedInUser'] = true;

        $totalWinnings = Winnings::select(DB::raw('sum(winning_total) AS winnings'))->where('winning_user', '=', Auth::id())->get();
        $data['totalWinnings'] = str_replace(".00","",money_format('$%i', $totalWinnings[0]['winnings']));
        $hasWinnings = $totalWinnings[0]['winnings'] > 0;
        $data['hasWinnings'] = $hasWinnings;

        $favoriteTeam = User::select(DB::raw('users.fav_team, teams.*'))
        ->join('teams', 'teams.id', '=', 'users.fav_team')
        ->where('users.id', '=', Auth::id())
        ->get();
        $data['favoriteTeam'] = $favoriteTeam;
        $hasFavTeam = count($favoriteTeam) > 0;
        $data['hasFavTeam'] = $hasFavTeam;

        $allTeams = DB::table('teams')
        ->where('teams.id', '!=', 33)
        ->where('teams.id', '!=', 34)
        ->get();
        $data['allTeams'] = $allTeams;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        return view('account.account')->with($data);
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show($id)
    {
        $isLoggedInUser = $id == Auth::id();

        if ($isLoggedInUser) {
            return redirect('/account');
        }

        $data=[];

        $user = User::select('*')->where('id', '=', $id)->get();

        if (count($user) < 1) {
            abort(404);
        }

        $data['id'] = $user[0]['id'];
        $data['first_name'] = $user[0]['first_name'];
        $data['last_name'] = $user[0]['last_name'];
        $data['username'] = $user[0]['username'];
        $data['email'] = $user[0]['email'];
        $data['avatar'] = $user[0]['avatar'];

        $currentGames = $this->getMyCurrentGames($this->currentWeek, $id);
        $data['currentGames'] = $currentGames;
        $hasCurrentGames = count($currentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;

        $gamesUserIsPlaying = Selections::where('user_id', "=", Auth::id())->groupBy("game_id")->get();
        $data['gamesUserIsPlaying'] = $gamesUserIsPlaying;
        $playingIn = [];
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
        $data['playingIn'] = $playingIn;
        $data['isLoggedInUser'] = $isLoggedInUser;

        $totalWinnings = Winnings::select(DB::raw('sum(winning_total) AS winnings'))->where('winning_user', '=', $id)->get();
        $data['totalWinnings'] = str_replace(".00","",money_format('$%i', $totalWinnings[0]['winnings']));
        $hasWinnings = $totalWinnings[0]['winnings'] > 0;
        $data['hasWinnings'] = $hasWinnings;

        $favoriteTeam = User::select(DB::raw('users.fav_team, teams.*'))
        ->join('teams', 'teams.id', '=', 'users.fav_team')
        ->where('users.id', '=', $id)
        ->get();
        $data['favoriteTeam'] = $favoriteTeam;
        $hasFavTeam = count($favoriteTeam) > 0;
        $data['hasFavTeam'] = $hasFavTeam;

        $allTeams = DB::table('teams')
        ->where('teams.id', '!=', 33) // NFC
        ->where('teams.id', '!=', 34) // AFC
        ->get();
        $data['allTeams'] = $allTeams;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        return view('account.account')->with($data);
    }

    public function getMyCurrentGames($currentWeekNo, $user)
    {
        $myCurrentGames = Games::select(DB::raw('games.*, selections.*, home_team.name as home, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->join('selections', 'games.id', '=', 'selections.game_id')
        ->where('selections.user_id', "=", $user)
        ->where('games.week', '=', $currentWeekNo)
        ->groupBy('selections.game_id')
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $myCurrentGames;
    }

    public function edit()
    {
        return view('account.edit');
    }

    public function update(Request $request)
    {
        $existingUser = User::find(\Auth::id());
        $existingUser->first_name = $request->first_name;
        $existingUser->last_name = $request->last_name;
        $existingUser->username = $request->username;
        $existingUser->email = $request->email;
        $existingUser->save();
        $request->session()->flash('successMessage', 'Account updated successfully!');

        return redirect('/dashboard');
    }

    public function editPassword()
    {
        return view('account.editPassword');
    }

    public function updatePassword(Request $request)
    {
        $existingUser = User::find(\Auth::id());
        $existingUser->password = bcrypt($request->password);
        $existingUser->save();
        $request->session()->flash('successMessage', 'Password updated successfully!');

        return redirect('/dashboard');
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
        $request->session()->flash('successMessage', 'Profile Image updated successfully!');

        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateFavTeam(Request $request)
    {
        $team = $request->favTeam;

        $user = User::find(\Auth::id());
        $user->fav_team = $team;
        $user->save();
        $request->session()->flash('successMessage', 'Favorite Team updated successfully!');

        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function destroy(Request $request)
    {
        // Delete Picks
        $pick = Selections::select('id')
        ->where('user_id', '=', \Auth::id());
        $pick->delete();

        // Delete Account
        $existingUser = User::find(\Auth::id());
        $existingUser->delete();

        $request->session()->flash('successMessage', 'Account deleted successfully!');

        return redirect('/');
    }
}
