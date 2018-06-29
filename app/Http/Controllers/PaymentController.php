<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Games;
use App\Models\Teams;
use App\Models\Selections;
use App\Models\Charity;
use App\User;
use Carbon\Carbon;
use DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function charge(Request $request, $amountToCharge)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_chvic2zLcRCTzOKL9ULbQhfN");

        $amount = $amountToCharge*100;

        $description = $request->description;
        $email = $request->email;
        $token = $request->stripeToken;

        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => $description,
            'receipt_email' => $email,
            'source' => $token,
        ]);

        $creditAmountAdded = $amount/100;

        // update user's credit
        $user = User::find(\Auth::id());
        $userId = $user->id;
        $getUserCurrentCredit = User::select('credit')->where('id', '=', $userId)->get();
        $userCurrentCreditAmount = $getUserCurrentCredit[0]['credit'];
        $updatedCreditAmount = $userCurrentCreditAmount + $creditAmountAdded;
        $user->credit = $updatedCreditAmount;
        $user->save();

        $request->session()->flash('successMessage', '$'.$creditAmountAdded.'.00 was added to your credit balance.');
        return redirect()->action('AccountController@dashboard');
    }
}
