<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdatePasswordRequest;

class ChangePasswordController extends Controller
{
    public function show()
    {
    	return view('users.change-password');
    }

    public function update(UpdatePasswordRequest $request)
    {
    	$user = \Auth::user();
        $user->password = bcrypt($request->new_password);
        
        if ($user->save()) $updateResponse = array('success' => trans('auth.change_password_success'));
        else $updateResponse = array('error' => trans('auth.change_password_error'));

    	return redirect()->back()->with($updateResponse); 
    }
}
