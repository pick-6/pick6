<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Selections;
use App\Models\Charities;
use App\Models\Games;

class ResultsController extends Controller
{
    public static function showGameWinner()
    {
        // $gameWinner = Selections::isWinner();
        $totalProceeds = Games::getUserMoneyToDonate();
        return view('gameResults')->with('totalProceeds', $totalProceeds)->with('gameWinner', true);
    }

}
