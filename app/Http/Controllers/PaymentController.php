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

    public function charge(Request $request)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_chvic2zLcRCTzOKL9ULbQhfN");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->stripeToken;

        $charge = \Stripe\Charge::create([
            'amount' => $request->amount,
            'currency' => 'usd',
            'description' => $request->description,
            'receipt_email' => $request->email,
            'source' => $token,
        ]);

        $creditAmount = ($request->amount)/100;

        $request->session()->flash('successMessage', '$'.$creditAmount.'.00 was added to your credit balance.');
        return redirect()->action('AccountController@dashboard');
    }
}
