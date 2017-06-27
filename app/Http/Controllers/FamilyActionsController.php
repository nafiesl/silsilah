<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FamilyActionsController extends Controller
{
    public function setFather(Request $request, User $user)
    {
        $this->validate($request, [
            'set_father' => 'required|string|max:255',
        ]);

        $father = new User;
        $father->nickname = $request->get('set_father');
        $father->gender_id = 1;

        $user->setFather($father);

        return back();
    }

    public function setMother(Request $request, User $user)
    {
        $this->validate($request, [
            'set_mother' => 'required|string|max:255',
        ]);

        $mother = new User;
        $mother->nickname = $request->get('set_mother');
        $mother->gender_id = 2;

        $user->setMother($mother);

        return back();
    }

    public function addChild(Request $request)
    {
        $this->validate($request, [
            'add_child_name' => 'required|string|max:255',
            'add_child_gender_id' => 'required|in:1,2',
        ]);

        $child = new User;
        $child->nickname = $request->get('add_child_name');
        $child->gender_id = $request->get('add_child_gender_id');
        $child->save();

        $user = auth()->user();

        if ($user->gender_id == 1)
            $child->setFather($user);
        else
            $child->setMother($user);

        return back();
    }
}
