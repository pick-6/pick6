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
    public static function showGameWinner()
    {
        // $gameWinner = Selections::isWinner();
        $totalProceeds = Games::getUserMoneyToDonate();
        $charities = Charity::get();
        return view('gameResults')->with(compact('totalProceeds', 'charities'))->with('gameWinner', true);
    }

}
