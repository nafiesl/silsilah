<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $usersMariageList = [];
        foreach ($user->couples as $spouse) {
            $usersMariageList[$spouse->pivot->id] = $user->name.' & '.$spouse->name;
        }

        $malePersonList = User::where('gender_id', 1)->pluck('nickname', 'id');
        $femalePersonList = User::where('gender_id', 2)->pluck('nickname', 'id');

        return view('users.show', [
            'user'             => $user,
            'usersMariageList' => $usersMariageList,
            'malePersonList'   => $malePersonList,
            'femalePersonList' => $femalePersonList,
        ]);
    }
}
