<?php

namespace App;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
        return $this->hasMany(User::class, 'parent_id')->orderBy('birth_order');
    }

    public function addChild(User $user)
    {
        $user->id = Uuid::uuid4()->toString();
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
