<?php

namespace App\Policies;

use App\User;
use App\Couple;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouplePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the couple.
     *
     * @param  \App\User  $user
     * @param  \App\Couple  $couple
     * @return mixed
     */
    public function edit(User $user, Couple $couple)
    {
        return $couple->manager_id == $user->id || is_system_admin($user);
    }
}
