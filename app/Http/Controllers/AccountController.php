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

        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        abort(404);
    }
}
