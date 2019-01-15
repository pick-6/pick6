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
        $this->middleware('auth', ['except'=>['postContact']]);
        parent::__construct();
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show($id = null)
    {
        if ($id == null) {
            $id = Auth::id();
        }
        $isLoggedInUser = $id == Auth::id();

        $data = [];

        $user = User::select('*')->where('id', '=', $id)->get();

        if (count($user) < 1) {
            abort(404);
        }

        $data['id'] = $user[0]['id'];
        $usersFirstName = $user[0]['first_name'];
        $data['first_name'] = $usersFirstName;
        $data['last_name'] = $user[0]['last_name'];
        $data['username'] = $user[0]['username'];
        $data['email'] = $user[0]['email'];
        $data['avatar'] = $user[0]['avatar'];
        $isAdmin = $this->isAdmin;
        $data['isAdmin'] = $isAdmin;

        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;
        $seasonType = $this->season_type;
        $data['season_type'] = $seasonType;
        $currentGames = GamesController::getMyCurrentGames($id, $seasonType, $currentWeek);;
        $data['currentGames'] = $currentGames;
        $hasCurrentGames = count($currentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;
        $datesOfCurrentWeekGames = GamesController::getDatesOfGames($seasonType, $currentWeek);
        $data['datesOfCurrentWeekGames'] = $datesOfCurrentWeekGames;
        $datesOfMyCurrentGames = GamesController::getDatesOfMyCurrentGames($id, $seasonType, $currentWeek);
        $data['datesOfMyCurrentGames'] = $datesOfMyCurrentGames;
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
        ->where('teams.id', '!=', 35) // null
        ->get();
        $data['allTeams'] = $allTeams;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $isPreSeason = $this->isPreSeason;
        $data['isPreSeason'] = $isPreSeason;
        $isRegularSeason = $this->isRegularSeason;
        $data['isRegularSeason'] = $isRegularSeason;
        $isPostSeason = $this->isPostSeason;
        $data['isPostSeason'] = $isPostSeason;
        if ($isPostSeason) {
            $data['gamesForWeekTitle'] = $this->postSeasonTitle;
        } else if ($isPreSeason) {
            $data['gamesForWeekTitle'] = "Games - Week $currentWeek";
        } else {
            $data['gamesForWeekTitle'] = "Games for Week $currentWeek";
        }
        $data['myCurrentGamesTitle'] = ($isLoggedInUser ? "My" : $usersFirstName."'s")." Current Games";
        $data['nextWeekGamesTitle'] = "Next Week's Games";
        $data['lastWeekResultsTitle'] = "Last Week's Results";
        $data['leaderboardTitle'] = "Leaderboard";
        $data['winningGamesTitle'] = ($isLoggedInUser ? "My" : $usersFirstName."'s")." Winning Games";

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
            'msg' => 'The '.$teamName.' were set as your favorite team.'
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

    public function postContact(Request $request)
    {
        try
        {
            $this->validate($request, ['email' => 'required|email']);

            $name = strip_tags(htmlspecialchars($_POST['name']));
            $email_address = strip_tags(htmlspecialchars($_POST['email']));
            $phone = strip_tags(htmlspecialchars($_POST['phone']));
            $message = strip_tags(htmlspecialchars($_POST['message']));

            // Create the email and send the message
            $to = 'mattvaldez01@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
            $email_subject = "Pick 6 Contact Form:  $name";
            $email_body = "You have received a new message from your Pick 6 contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
            $headers = "From: noreply@pick6.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
            $headers .= "Reply-To: $email_address";
            mail($to,$email_subject,$email_body,$headers);

            $response = response()->json([ 'success' => true, 'msg' => 'Your message has been sent.']);
        }
        catch (\Exception $e)
        {
            $response = response()->json([ 'success' => false, 'msg' => $e->getMessage()]);
        }

        return $response;
    }

    public function getUserWinningGames(Request $request)
    {
        $data = [];

        $userId = $request->userId;
        $data['userId'] = $userId;

        $winningGames = Winnings::select(DB::raw('games.*, winnings.*, home_team.city as home_city, home_team.name as home, away_team.city as away_city, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join('games', 'winnings.game_id', '=', 'games.id')
        ->where('winnings.winning_user', '=', $userId)
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        $data['winningGames'] = $winningGames;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $includeTitle = $request->includeTitle ?? true;
        $data['includeTitle'] = $includeTitle;
        $data['title'] = "Winning Games";

        $totalWinnings = Winnings::select(DB::raw('sum(winning_total) AS winnings'))->where('winning_user', '=', $userId)->get();
        $data['totalWinnings'] = str_replace(".00","",money_format('$%i', $totalWinnings[0]['winnings']));
        $hasWinnings = $totalWinnings[0]['winnings'] > 0;
        $data['hasWinnings'] = $hasWinnings;

        $datesOfWinningGames = GamesController::getDatesOfWinningGames($userId);
        $data['datesOfWinningGames'] = $datesOfWinningGames;

        $isLoggedInUser = $userId == Auth::id();
        $data['isLoggedInUser'] = $isLoggedInUser;

        $user = User::select('*')->where('id', '=', $userId)->get();
        $usersFirstName = $user[0]['first_name'];
        $data['usersFirstName'] = $usersFirstName;

        return view('account.winningGames')->with($data);
    }

    public function getUserFavTeamLogo(Request $request)
    {
        $data = [];

        $id = $request->userId;
        if ($id == null) {
            $id = Auth::id();
        }
        $data['id'] = $id;

        $isLoggedInUser = $id == Auth::id();
        $data['isLoggedInUser'] = $isLoggedInUser;

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
        ->where('teams.id', '!=', 35) // null
        ->get();
        $data['allTeams'] = $allTeams;

        return view('account.partials.favTeam')->with($data);
    }

    public function getUserAvatar(Request $request)
    {
        $data = [];

        $id = $request->userId;
        if ($id == null) {
            $id = Auth::id();
        }
        $data['id'] = $id;

        $isLoggedInUser = $id == Auth::id();
        $data['isLoggedInUser'] = $isLoggedInUser;

        $user = User::select('*')->where('id', '=', $id)->get();
        if (count($user) < 1) {
            abort(404);
        }

        $avatar = $user[0]['avatar'];
        $data['avatar'] = $avatar;

        return view('account.partials.avatar')->with($data);
    }
}
