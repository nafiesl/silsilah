<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ManageUserFamiliesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_update_their_father()
    {
        $user = $this->loginAsUser();
        $this->visit(route('profile'));
        $this->seePageIs(route('profile'));

        $this->submitForm('set_father_button', [
            'set_father' => 'Nama Ayah',
        ]);

        $this->seeInDatabase('users', [
            'nickname' => 'Nama Ayah',
        ]);

        $this->assertEquals('Nama Ayah', $user->fresh()->father->nickname);
    }

    /** @test */
    public function user_can_update_their_mother()
    {
        $user = $this->loginAsUser();
        $this->visit(route('profile'));
        $this->seePageIs(route('profile'));

        // $this->see($user->nickname);
        // $this->seeElement('input', ['name' => 'set_mother']);
        $this->seeElement('input', ['name' => 'set_mother']);
        // $this->seeElement('input', ['name' => 'add_child_name']);
        // $this->seeElement('input', ['name' => 'add_child_gender_id']);

        $this->submitForm('set_mother_button', [
            'set_mother' => 'Nama Ibu',
        ]);

        $this->seeInDatabase('users', [
            'nickname' => 'Nama Ibu',
        ]);

        $this->assertEquals('Nama Ibu', $user->fresh()->mother->nickname);
    }
}
