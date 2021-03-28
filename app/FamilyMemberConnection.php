<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMemberConnection extends Model
{
    protected $fillable = [
        'id', 'requester_id', 'requested_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
