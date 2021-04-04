<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMetadata extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';
}
