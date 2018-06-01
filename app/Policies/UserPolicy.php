<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, User $editableUser)
    {
        return $editableUser->id == $user->id || $editableUser->manager_id == $user->id;
    }

    public function delete(User $user, User $editableUser)
    {
        return $editableUser->manager_id == $user->id && $editableUser->id != $user->id;
    }
}
