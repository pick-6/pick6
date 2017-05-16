<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Selections;

class ResultsController extends Controller
{
    public function showGameWinner()
    {
        $gameWinner = 'app/Models/Selections::isWinner()';
        $totalProceeds = 'app/Models/Charities::getMoney()';
        return view('gameResults', compact('gameWinner', 'totalProceeds'));
    }

}
