<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Games;
use App\Models\Teams;
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
        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;
        $seasonType = $this->season_type;
        $data['season_type'] = $seasonType;
        $currentGames = GamesController::getMyCurrentGames(Auth::id(), $seasonType, $currentWeek);
        $data['currentGames'] = $currentGames;
        $hasCurrentGames = count($currentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;
        $playingIn = GamesController::gamesUserIsPlayingIn(Auth::id());
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

        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;
        $seasonType = $this->season_type;
        $data['season_type'] = $seasonType;
        $currentGames = GamesController::getMyCurrentGames($id, $seasonType, $currentWeek);;
        $data['currentGames'] = $currentGames;
        $hasCurrentGames = count($currentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;

        $playingIn = GamesController::gamesUserIsPlayingIn(Auth::id());
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

    public function edit()
    {
        return view('account.edit');
    }

    public function update(Request $request)
    {
        try
        {
            $existingUser = User::find(\Auth::id());
            $existingUser->first_name = $request->first_name;
            $existingUser->last_name = $request->last_name;
            $existingUser->username = $request->username;
            $existingUser->email = $request->email;
            $existingUser->save();
        }
        catch (\Exception $e)
        {
            $response = response()->json([
                'success' => false,
                'msg' => 'Failed to update account info.'
            ]);
            return $response;
        }

        $response = response()->json([
            'success' => true,
            'msg' => 'Account updated successfully!'
        ]);
        return $response;
    }

    public function editPassword()
    {
        return view('account.editPassword');
    }

    public function updatePassword(Request $request)
    {
        try
        {
            $existingUser = User::find(\Auth::id());
            $existingUser->password = bcrypt($request->password);
            $existingUser->save();
        }
        catch (\Exception $e)
        {
            $response = response()->json([
                'success' => false,
                'msg' => 'Failed to update password.'
            ]);
            return $response;
        }

        $response = response()->json([
            'success' => true,
            'msg' => 'Password updated successfully!'
        ]);
        return $response;
    }

    public function uploadProfilePic(Request $request)
    {
        try
        {
            if ($request->hasFile('avatar'))
            {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/img/profilePics/' . $filename ) );

                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }
        }
        catch (\Exception $e)
        {
            $response = response()->json([
                'success' => false,
                'msg' => 'Failed to update profile image.'
            ]);
            return $response;
        }

        $response = response()->json([
            'success' => true,
            'msg' => 'Your profile image was updated successfully!'
        ]);
        return $response;
    }

    public function updateFavTeam(Request $request)
    {
        try
        {
            $team = $request->favTeam;
            $user = User::find(\Auth::id());
            $user->fav_team = $team;
            $user->save();
        }
        catch (\Exception $e)
        {
            $response = response()->json([
                'success' => false,
                'msg' => 'Failed to update your favorite team.'
            ]);
            return $response;
        }

        $favTeam = Teams::select('name')->where('id', '=', $team)->get();
        $teamName = $favTeam[0]['name'];


        $response = response()->json([
            'success' => true,
            'msg' => $teamName.' set as your favorite team.'
        ]);
        return $response;
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
