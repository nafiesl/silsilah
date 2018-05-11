<?php

namespace App\Http\Controllers;

use App\Couple;
use App\User;
use Illuminate\Http\Request;
use Storage;

class UsersController extends Controller
{
    /**
     * Search user by keyword.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $q = $request->get('q');
        $users = [];

        if ($q) {
            $users = User::with('father', 'mother')->where(function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%');
                $query->orWhere('nickname', 'like', '%'.$q.'%');
            })
                ->orderBy('name', 'asc')
                ->paginate(24);
        }

        return view('users.search', compact('users'));
    }

    /**
     * Display the specified User.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $usersMariageList = [];
        foreach ($user->couples as $spouse) {
            $usersMariageList[$spouse->pivot->id] = $user->name.' & '.$spouse->name;
        }

        $allMariageList = [];
        foreach (Couple::with('husband', 'wife')->get() as $couple) {
            $allMariageList[$couple->id] = $couple->husband->name.' & '.$couple->wife->name;
        }

        $malePersonList = User::where('gender_id', 1)->pluck('nickname', 'id');
        $femalePersonList = User::where('gender_id', 2)->pluck('nickname', 'id');

        return view('users.show', [
            'user'             => $user,
            'usersMariageList' => $usersMariageList,
            'malePersonList'   => $malePersonList,
            'femalePersonList' => $femalePersonList,
            'allMariageList'   => $allMariageList,
        ]);
    }

    /**
     * Display the user's family chart.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function chart(User $user)
    {
        $father = $user->father_id ? $user->father : null;
        $mother = $user->mother_id ? $user->mother : null;

        $fatherGrandpa = $father && $father->father_id ? $father->father : null;
        $fatherGrandma = $father && $father->mother_id ? $father->mother : null;

        $motherGrandpa = $mother && $mother->father_id ? $mother->father : null;
        $motherGrandma = $mother && $mother->mother_id ? $mother->mother : null;

        $childs = $user->childs;
        $colspan = $childs->count();
        $colspan = $colspan < 4 ? 4 : $colspan;

        $siblings = $user->siblings();
        return view('users.chart', compact('user', 'childs', 'father', 'mother', 'fatherGrandpa', 'fatherGrandma', 'motherGrandpa', 'motherGrandma', 'siblings', 'colspan'));
    }

    /**
     * Show user family tree
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function tree(User $user)
    {
        return view('users.tree', compact('user'));
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nickname'  => 'required|string|max:255',
            'name'      => 'required|string|max:255',
            'gender_id' => 'required|numeric',
            'dob'       => 'nullable|date|date_format:Y-m-d',
            'dod'       => 'nullable|date|date_format:Y-m-d',
            'yod'       => 'nullable|date_format:Y',
            'phone'     => 'nullable|string|max:255',
            'job'       => 'nullable|string|max:255',
            'address'   => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
            'email'     => 'nullable|string|max:255',
            'password'  => 'nullable|min:6|max:15',
        ]);

        $user->nickname = $request->nickname;
        $user->name = $request->get('name');
        $user->gender_id = $request->get('gender_id');
        $user->dob = $request->get('dob');
        $user->dod = $request->get('dod');

        if ($request->get('dod')) {
            $user->yod = substr($request->get('dod'), 0, 4);
        } else {
            $user->yod = $request->get('yod');
        }

        $user->phone = $request->get('phone');
        $user->job = $request->get('job');
        $user->address = $request->get('address');
        $user->city = $request->get('city');
        $user->email = $request->get('email');

        if ($request->get('email')) {
            $user->password = bcrypt($request->get('email'));
        }

        $user->save();

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete('manager_id');
        return redirect()->route('users.search');
    }

    /**
     * Upload users photo.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $user
     *
     * @return \Illuminate\Http\Response
     */
    public function photoUpload(Request $request, User $user)
    {
        $request->validate([
            'photo' => 'required|image|max:200',
        ]);

        $storage = env('APP_ENV') == 'testing' ? 'avatars' : 'public';

        if (Storage::disk($storage)->exists($user->photo_path)) {
            Storage::disk($storage)->delete($user->photo_path);
        }

        $user->photo_path = $request->photo->store('images', $storage);
        $user->save();

        return back();
    }
}
