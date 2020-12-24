<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Couple extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public function husband()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'N/A']);
    }

    public function wife()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'N/A']);
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
