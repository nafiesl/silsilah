<?php

namespace App\Http\Controllers\Users;

use App\FamilyMemberConnection;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class FamilyConnectionRequestController extends Controller
{
    public function store(Request $request, User $user)
    {
        FamilyMemberConnection::create([
            'id'           => Uuid::uuid4()->toString(),
            'requester_id' => auth()->id(),
            'requested_id' => $user->id,
            'status_id'    => FamilyMemberConnection::STATUS_WAITING,
        ]);

        return back();
    }
}
