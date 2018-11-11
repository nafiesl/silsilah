<?php

namespace App\Http\Controllers;

use App\User;

class UserMarriagesController extends Controller
{
    /**
     * Show user marriage list.
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function index(User $user)
    {
        $marriages = $user->marriages()->with('husband', 'wife')
            ->withCount('childs')->get();

        return view('users.marriages', compact('user', 'marriages'));
    }
}
