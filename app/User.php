<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    public function getGenderAttribute()
    {
        return $this->gender_id == 1 ? 'Laki-laki' : 'Perempuan';
    }

    public function setFather(User $father)
    {
        if ($father->gender_id === 1) {

            if ($father->exists == false)
                $father->save();

            $this->father_id = $father->id;
            $this->save();

            return $father;
        }

        return false;
    }

    public function setMother(User $mother)
    {
        if ($mother->gender_id === 2) {

            if ($mother->exists == false)
                $mother->save();

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
        if ($this->gender_id == 2)
            return $this->hasMany(User::class, 'mother_id');

        return $this->hasMany(User::class, 'father_id');
    }

    public function profileLink()
    {
        $linkText = $this->name ?: $this->nickname;
        return link_to_route('users.show', $linkText, [$this->id]);
    }
}
