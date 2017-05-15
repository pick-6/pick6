<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    public function showGameWinner()
    {
        $gameWinner = 'app/Models/Selections::isWinner()';
        return view('gameResults', compact('gameWinner'));
    }
}
