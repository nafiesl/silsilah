<?php

namespace App\Http\Controllers;

use App\Couple;
use Illuminate\Http\Request;

class CouplesController extends Controller
{
    public function show(Couple $couple)
    {
        return view('couples.show', compact('couple'));
    }
}
