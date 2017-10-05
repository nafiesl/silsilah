<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserMarriagesController extends Controller
{
    public function index(User $user)
    {
        $marriages = $user->marriages()->with('husband', 'wife')->withCount('childs')->get();
        return view('users.marriages', compact('user', 'marriages'));
    }
}
