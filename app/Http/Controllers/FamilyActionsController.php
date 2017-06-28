<?php

namespace App\Http\Controllers;

use App\Couple;
use App\User;
use Illuminate\Http\Request;

class FamilyActionsController extends Controller
{
    public function setFather(Request $request, User $user)
    {
        $this->validate($request, [
            'set_father_id' => 'nullable',
            'set_father' => 'required_without:set_father_id|max:255',
        ]);

        if ($request->get('set_father_id')) {
            $user->father_id = $request->get('set_father_id');
            $user->save();
        } else {
            $father = new User;
            $father->name = $request->get('set_father');
            $father->nickname = $request->get('set_father');
            $father->gender_id = 1;

            $user->setFather($father);
        }

        return back();
    }

    public function setMother(Request $request, User $user)
    {
        $this->validate($request, [
            'set_mother_id' => 'nullable',
            'set_mother' => 'required_without:set_mother_id|max:255',
        ]);

        if ($request->get('set_mother_id')) {
            $user->mother_id = $request->get('set_mother_id');
            $user->save();
        } else {
            $mother = new User;
            $mother->name = $request->get('set_mother');
            $mother->nickname = $request->get('set_mother');
            $mother->gender_id = 2;

            $user->setMother($mother);
        }

        return back();
    }

    public function addChild(Request $request, User $user)
    {
        $this->validate($request, [
            'add_child_name' => 'required|string|max:255',
            'add_child_gender_id' => 'required|in:1,2',
            'add_child_parent_id' => 'nullable|exists:couples,id',
        ]);

        $child = new User;
        $child->name = $request->get('add_child_name');
        $child->nickname = $request->get('add_child_name');
        $child->gender_id = $request->get('add_child_gender_id');
        $child->parent_id = $request->get('add_child_parent_id');

        \DB::beginTransaction();
        $child->save();

        if ($request->get('add_child_parent_id')) {
            $couple = Couple::find($request->get('add_child_parent_id'));
            $child->father_id = $couple->husband_id;
            $child->mother_id = $couple->wife_id;
            $child->save();
        } else {
            if ($user->gender_id == 1)
                $child->setFather($user);
            else
                $child->setMother($user);
        }

        \DB::commit();

        return back();
    }

    public function addWife(Request $request, User $user)
    {
        $this->validate($request, [
            'set_wife_id' => 'nullable',
            'set_wife' => 'required_without:set_wife_id|max:255',
        ]);

        if ($request->get('set_wife_id')) {
            $wife = User::findOrFail($request->get('set_wife_id'));
        } else {
            $wife = new User;
            $wife->name = $request->get('set_wife');
            $wife->nickname = $request->get('set_wife');
            $wife->gender_id = 2;
        }

        $user->addWife($wife);

        return back();
    }

    public function addHusband(Request $request, User $user)
    {
        $this->validate($request, [
            'set_husband_id' => 'nullable',
            'set_husband' => 'required_without:set_husband_id|max:255',
        ]);

        if ($request->get('set_husband_id')) {
            $husband = User::findOrFail($request->get('set_husband_id'));
        } else {
            $husband = new User;
            $husband->name = $request->get('set_husband');
            $husband->nickname = $request->get('set_husband');
            $husband->gender_id = 1;
        }

        $user->addHusband($husband);

        return back();
    }

    public function setParent(Request $request, User $user)
    {
        $user->parent_id = $request->get('set_parent_id');
        $user->save();

        return redirect()->route('users.show', $user->id);
    }
}
