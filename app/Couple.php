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

    public function childs()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function addChild(User $user)
    {
        $user->parent_id = $this->id;
        $user->father_id = $this->husband_id;
        $user->mother_id = $this->wife_id;
        $user->save();
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }
}
