<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ManageUserFamiliesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_update_their_family_members()
    {
        $user = $this->loginAsUser();
        $this->visit(route('profile'));
        $this->seePageIs(route('profile'));

        $this->see($user->nickname);
        $this->seeElement('input', ['name' => 'set_father']);
        $this->seeElement('input', ['name' => 'set_mother']);
        $this->seeElement('input', ['name' => 'add_child_name']);
        $this->seeElement('input', ['name' => 'add_child_gender_id']);
    }
}
