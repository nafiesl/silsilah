<?php

namespace App\Http\Controllers\Users;

use App\FamilyConnection;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class FamilyConnectionRequestController extends Controller
{
    public function store(Request $request, User $user)
    {
        FamilyConnection::create([
            'id'           => Uuid::uuid4()->toString(),
            'requester_id' => auth()->id(),
            'requested_id' => $user->id,
            'status_id'    => FamilyConnection::STATUS_WAITING,
        ]);

        return back();
    }
}
