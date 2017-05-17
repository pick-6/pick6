<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Selections;
use App\Models\Charities;
use App\Models\Games;
use App\Models\Charity;


class ResultsController extends Controller
{
    public static function showGameWinner($id, $selection)
    {
        $gameWinner = Selections::isWinner($id, $selection);
        $totalProceeds = Games::getUserMoneyToDonate($id);
        $sumOfDonations = Games::totalDonationPerGame($id);
        $charities = Charity::get();
        return view('gameResults')->with(compact('totalProceeds', 'charities', 'sumOfDonations', 'gameWinner'));
    }

}
