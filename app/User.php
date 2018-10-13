<?php

namespace App;

use Ramsey\Uuid\Uuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'birth_order',
        'nickname', 'gender_id', 'name',
        'email', 'password',
        'address', 'phone',
        'dof', 'dod',
        'father_id', 'mother_id', 'parent_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'gender',
    ];

    protected $casts = [
        'couples.pivot.id'  => 'string',
        'wifes.pivot.id'    => 'string',
        'husbands.pivot.id' => 'string',
    ];

    // protected $keyType = 'string';

    public function getGenderAttribute()
    {
        return $this->gender_id == 1 ? trans('app.male_code') : trans('app.female_code');
    }

    public function setFather(User $father)
    {
        if ($father->gender_id == 1) {

            if ($father->exists == false) {
                $father->save();
            }

            $this->father_id = $father->id;
            $this->save();

            return $father;
        }

        return false;
    }

    public function setMother(User $mother)
    {
        if ($mother->gender_id == 2) {

            if ($mother->exists == false) {
                $mother->save();
            }

            $this->mother_id = $mother->id;
            $this->save();

            return $mother;
        }

        return false;
    }

    public function father()
    {
        return $this->belongsTo(User::class);
    }

    public function mother()
    {
        return $this->belongsTo(User::class);
    }

    public function childs()
    {
        if ($this->gender_id == 2) {
            return $this->hasMany(User::class, 'mother_id');
        }

        return $this->hasMany(User::class, 'father_id');
    }

    public function profileLink($type = 'profile')
    {
        $type = ($type == 'chart') ? 'chart' : 'show';
        return link_to_route('users.'.$type, $this->name, [$this->id]);
    }

    public function fatherLink()
    {
        return $this->father_id ? link_to_route('users.show', $this->father->name, [$this->father_id]) : null;
    }

    public function motherLink()
    {
        return $this->mother_id ? link_to_route('users.show', $this->mother->name, [$this->mother_id]) : null;
    }

    public function wifes()
    {
        return $this->belongsToMany(User::class, 'couples', 'husband_id', 'wife_id')->using('App\CouplePivot')->withPivot(['id'])->withTimestamps();
    }

    public function addWife(User $wife, $marriageDate = null)
    {
        if ($this->gender_id == 1 && !$this->hasBeenMarriedTo($wife)) {
            $this->wifes()->save($wife, [
                'id'            => Uuid::uuid4()->toString(),
                'marriage_date' => $marriageDate,
            ]);
            return $wife;
        }

        return false;
    }

    public function husbands()
    {
        return $this->belongsToMany(User::class, 'couples', 'wife_id', 'husband_id')->using('App\CouplePivot')->withPivot(['id'])->withTimestamps();
    }

    public function addHusband(User $husband, $marriageDate = null)
    {
        if ($this->gender_id == 2 && !$this->hasBeenMarriedTo($husband)) {
            $this->husbands()->save($husband, [
                'id'            => Uuid::uuid4()->toString(),
                'marriage_date' => $marriageDate,
            ]);
            return $husband;
        }

        return false;
    }

    public function hasBeenMarriedTo(User $user)
    {
        return $this->couples->contains($user);
    }

    public function couples()
    {
        if ($this->gender_id == 1) {
            return $this->belongsToMany(User::class, 'couples', 'husband_id', 'wife_id')->using('App\CouplePivot')->withPivot(['id'])->withTimestamps();
        }

        return $this->belongsToMany(User::class, 'couples', 'wife_id', 'husband_id')->using('App\CouplePivot')->withPivot(['id'])->withTimestamps();
    }

    public function marriages()
    {
        if ($this->gender_id == 1) {
            return $this->hasMany(Couple::class, 'husband_id');
        }

        return $this->hasMany(Couple::class, 'wife_id');
    }

    public function siblings()
    {
        if (is_null($this->father_id) && is_null($this->mother_id) && is_null($this->parent_id)) {
            return collect([]);
        }

        return User::where('id', '!=', $this->id)
            ->where(function ($query) {
                if (!is_null($this->father_id)) {
                    $query->where('father_id', $this->father_id);
                }

                if (!is_null($this->mother_id)) {
                    $query->orWhere('mother_id', $this->mother_id);
                }

                if (!is_null($this->parent_id)) {
                    $query->orWhere('parent_id', $this->parent_id);
                }

            })
            ->get();
    }

    public function parent()
    {
        return $this->belongsTo(Couple::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function managedUsers()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function managedCouples()
    {
        return $this->hasMany(Couple::class, 'manager_id');
    }
}
