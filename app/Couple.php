<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    public function husband()
    {
        return $this->belongsTo(User::class);
    }

    public function wife()
    {
        return $this->belongsTo(User::class);
    }
}
