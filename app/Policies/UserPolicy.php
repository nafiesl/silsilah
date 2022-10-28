<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the user data.
     *
     * @param  \App\User  $user
     * @param  \App\User  $editableUser
     * @return mixed
     */
    public function edit(User $user, User $editableUser)
    {
        if ($editableUser->id == $user->father_id || $editableUser->id == $user->mother_id) return true; //parent
        if ($editableUser->father_id == $user->id || $editableUser->mother_id == $user->id) return true; //child

        $husbands = $user->husbands()->get();
        foreach($husbands as $key=>$value) {
            if ($editableUser->id == $value->id) return true;
        }
        
        $wifes = $user->wifes()->get();
        foreach($wifes as $key=>$value) {
            if ($editableUser->id == $value->id) return true;
        }        

        return $editableUser->id == $user->id || $editableUser->manager_id == $user->id || is_system_admin($user);
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $editableUser
     * @return mixed
     */
    public function delete(User $user, User $editableUser)
    {
        return ($editableUser->manager_id == $user->id || is_system_admin($user)) && $editableUser->id != $user->id;
    }
}
