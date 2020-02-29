<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BirthdayController extends Controller
{
    public function index()
    {
        $userBirthdayQuery = User::whereNotNull('dob')
            ->select('users.name',
                'users.dob',
                'users.id as user_id'
            );

        $currentMonth = Carbon::now()->format('m');
        $nextMonth = Carbon::now()->addMonth()->format('m');
        $userBirthdayQuery->whereIn(DB::raw("month(dob)"), [$currentMonth, $nextMonth]);

        $users = $userBirthdayQuery->get()->filter(function ($user) {
            return $user->birthday_remaining < 60 && $user->birthday_remaining >= 0;
        })->sortBy('birthday_remaining');

        return view('birthdays.index', compact('users', 'currentMonth', 'nextMonth'));
    }
}
