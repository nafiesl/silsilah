<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdatePasswordRequest;

class ChangePasswordController extends Controller
{
    /**
     * Display change user password form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('users.change-password');
    }

    /**
     * Proccessing user password change.
     *
     * @param  \App\Http\Requests\Users\UpdatePasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePasswordRequest $request)
    {
        $user = \Auth::user();
        $user->password = bcrypt($request->new_password);
        $updateResponse = array('error' => __('auth.change_password_error'));

        if ($user->save()) {
            $updateResponse = array('success' => __('auth.change_password_success'));
        }

        return redirect()->back()->with($updateResponse);
    }
}
