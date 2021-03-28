<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMemberConnection extends Model
{
    const STATUS_WAITING = 0;
    const STATUS_APPROVED = 1;

    protected $fillable = [
        'id', 'requester_id', 'requested_id', 'status_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
