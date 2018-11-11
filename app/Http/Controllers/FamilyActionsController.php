<?php

namespace App\Http\Controllers;

use App\User;
use App\Couple;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class FamilyActionsController extends Controller
{
    /**
     * Set father for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setFather(Request $request, User $user)
    {
        $request->validate([
            'set_father_id' => 'nullable',
            'set_father'    => 'required_without:set_father_id|max:255',
        ]);

        if ($request->get('set_father_id')) {
            $user->father_id = $request->get('set_father_id');
            $user->save();
        } else {
            $father = new User;
            $father->id = Uuid::uuid4()->toString();
            $father->name = $request->get('set_father');
            $father->nickname = $request->get('set_father');
            $father->gender_id = 1;
            $father->manager_id = auth()->id();

            $user->setFather($father);
        }

        return back();
    }

    /**
     * Set mother for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setMother(Request $request, User $user)
    {
        $request->validate([
            'set_mother_id' => 'nullable',
            'set_mother'    => 'required_without:set_mother_id|max:255',
        ]);

        if ($request->get('set_mother_id')) {
            $user->mother_id = $request->get('set_mother_id');
            $user->save();
        } else {
            $mother = new User;
            $mother->id = Uuid::uuid4()->toString();
            $mother->name = $request->get('set_mother');
            $mother->nickname = $request->get('set_mother');
            $mother->gender_id = 2;
            $mother->manager_id = auth()->id();

            $user->setMother($mother);
        }

        return back();
    }

    /**
     * Add child for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addChild(Request $request, User $user)
    {
        $request->validate([
            'add_child_name'        => 'required|string|max:255',
            'add_child_gender_id'   => 'required|in:1,2',
            'add_child_parent_id'   => 'nullable|exists:couples,id',
            'add_child_birth_order' => 'nullable|numeric',
        ]);

        $child = new User;
        $child->id = Uuid::uuid4()->toString();
        $child->name = $request->get('add_child_name');
        $child->nickname = $request->get('add_child_name');
        $child->gender_id = $request->get('add_child_gender_id');
        $child->parent_id = $request->get('add_child_parent_id');
        $child->birth_order = $request->get('add_child_birth_order');
        $child->manager_id = auth()->id();

        \DB::beginTransaction();
        $child->save();

        if ($request->get('add_child_parent_id')) {
            $couple = Couple::find($request->get('add_child_parent_id'));
            $child->father_id = $couple->husband_id;
            $child->mother_id = $couple->wife_id;
            $child->save();
        } else {
            if ($user->gender_id == 1) {
                $child->setFather($user);
            } else {
                $child->setMother($user);
            }

        }

        \DB::commit();

        return back();
    }

    /**
     * Add wife for male user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addWife(Request $request, User $user)
    {
        $request->validate([
            'set_wife_id'   => 'nullable',
            'set_wife'      => 'required_without:set_wife_id|max:255',
            'marriage_date' => 'nullable|date|date_format:Y-m-d',
        ]);

        if ($request->get('set_wife_id')) {
            $wife = User::findOrFail($request->get('set_wife_id'));
        } else {
            $wife = new User;
            $wife->id = Uuid::uuid4()->toString();
            $wife->name = $request->get('set_wife');
            $wife->nickname = $request->get('set_wife');
            $wife->gender_id = 2;
            $wife->manager_id = auth()->id();
        }

        $user->addWife($wife, $request->get('marriage_date'));

        return back();
    }

    /**
     * Add husband for female user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addHusband(Request $request, User $user)
    {
        $this->validate($request, [
            'set_husband_id' => 'nullable',
            'set_husband'    => 'required_without:set_husband_id|max:255',
            'marriage_date'  => 'nullable|date|date_format:Y-m-d',
        ]);

        if ($request->get('set_husband_id')) {
            $husband = User::findOrFail($request->get('set_husband_id'));
        } else {
            $husband = new User;
            $husband->id = Uuid::uuid4()->toString();
            $husband->name = $request->get('set_husband');
            $husband->nickname = $request->get('set_husband');
            $husband->gender_id = 1;
            $husband->manager_id = auth()->id();
        }

        $user->addHusband($husband, $request->get('marriage_date'));

        return back();
    }

    /**
     * Set parent for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setParent(Request $request, User $user)
    {
        $user->parent_id = $request->get('set_parent_id');
        $user->save();

        return redirect()->route('users.show', $user);
    }
}
