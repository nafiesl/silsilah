<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FamilyActionsController extends Controller
{
    public function setFather(Request $request, User $user)
    {
        $father = new User;
        $father->nickname = $request->get('set_father');
        $father->gender_id = 1;

        $user->setFather($father);

        return back();
    }

    public function setMother(Request $request, User $user)
    {
        $mother = new User;
        $mother->nickname = $request->get('set_mother');
        $mother->gender_id = 2;

        $user->setMother($mother);

        return back();
    }
}
