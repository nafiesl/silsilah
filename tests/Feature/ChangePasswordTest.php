<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_change_password()
    {
        $user = $this->loginAsUser(['password' => bcrypt('secret')]);

        $this->visit(route('home'));
        $this->click(__('auth.change_password'));

        $this->submitForm(__('auth.change_password'), [
            'old_password'              => 'secret',
            'new_password'              => 'rahasia',
            'new_password_confirmation' => 'rahasia',
        ]);

        $this->seeText(__('auth.change_password_success'));

        $this->assertTrue(
            app('hash')->check('rahasia', $user->password),
            'The password should changed!'
        );
    }

    /** @test */
    public function user_cannot_change_password_if_old_password_wrong()
    {
        $user = $this->loginAsUser(['password' => bcrypt('secret')]);

        $this->visit(route('home'));
        $this->click(__('auth.change_password'));

        $this->submitForm(__('auth.change_password'), [
            'old_password'              => 'member1',
            'new_password'              => 'rahasia',
            'new_password_confirmation' => 'rahasia',
        ]);

        $this->seeText(__('passwords.old_password'));

        $this->assertTrue(
            app('hash')->check('secret', $user->password),
            'The password shouldn\'t changed!'
        );
    }
}
