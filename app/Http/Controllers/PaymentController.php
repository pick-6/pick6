<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Games;
use App\Models\Teams;
use App\Models\Selections;
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
        try
        {
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

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

        }
        catch (\Stripe\Error\Card $e)
        {
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $message = $err['message'];

            $request->session()->flash('errorMessage', $message);
            return redirect('/dashboard');
        }

        // update user's credit
        $creditAmountAdded = $amount/100;
        $user = User::find(\Auth::id());
        $userId = $user->id;
        $getUserCurrentCredit = User::select('credit')->where('id', '=', $userId)->get();
        $userCurrentCreditAmount = $getUserCurrentCredit[0]['credit'];
        $updatedCreditAmount = $userCurrentCreditAmount + $creditAmountAdded;
        $user->credit = $updatedCreditAmount;
        $user->save();

        $request->session()->flash('successMessage', '$'.$creditAmountAdded.'.00 was added to your credit balance.');
        return redirect('/dashboard');
    }
}
