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
        return $editableUser->id == $user->id
        || $editableUser->manager_id == $user->id
        || is_system_admin($user)
        || $editableUser->id == $user->father_id
        || $editableUser->id == $user->mother_id
        || $editableUser->father_id == $user->id
        || $editableUser->mother_id == $user->id
        || $user->husbands->pluck('id')->contains($editableUser->id)
        || $user->wifes->pluck('id')->contains($editableUser->id);
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
