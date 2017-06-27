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
        $father->name = $request->get('set_father');
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
        $mother->name = $request->get('set_mother');
        $mother->nickname = $request->get('set_mother');
        $mother->gender_id = 2;

        $user->setMother($mother);

        return back();
    }

    public function addChild(Request $request, User $user)
    {
        $this->validate($request, [
            'add_child_name' => 'required|string|max:255',
            'add_child_gender_id' => 'required|in:1,2',
        ]);

        $child = new User;
        $child->name = $request->get('add_child_name');
        $child->nickname = $request->get('add_child_name');
        $child->gender_id = $request->get('add_child_gender_id');
        $child->save();

        if ($user->gender_id == 1)
            $child->setFather($user);
        else
            $child->setMother($user);

        return back();
    }

    public function addWife(Request $request, User $user)
    {
        $this->validate($request, [
            'set_wife' => 'required|string|max:255',
        ]);

        $wife = new User;
        $wife->name = $request->get('set_wife');
        $wife->nickname = $request->get('set_wife');
        $wife->gender_id = 2;

        $user->addWife($wife);

        return back();
    }

    public function addHusband(Request $request, User $user)
    {
        $this->validate($request, [
            'set_husband' => 'required|string|max:255',
        ]);

        $husband = new User;
        $husband->name = $request->get('set_husband');
        $husband->nickname = $request->get('set_husband');
        $husband->gender_id = 1;

        $user->addHusband($husband);

        return back();
    }
}
