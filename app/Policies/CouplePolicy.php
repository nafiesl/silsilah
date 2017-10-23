<?php

namespace App\Policies;

use App\Couple;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouplePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Couple $editableCouple)
    {
        return $editableCouple->manager_id == $user->id;
    }
}
