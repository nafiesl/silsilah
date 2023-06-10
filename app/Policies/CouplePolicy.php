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
        if (is_system_admin($user)) {
            return true;
        }

        if ($couple->manager_id == $user->id) {
            return true;
        }

        if ($couple->husband_id == $user->id) {
            return true;
        }

        if ($couple->wife_id == $user->id) {
            return true;
        }

        return false;
    }
}
