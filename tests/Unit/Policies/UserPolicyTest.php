<?php

namespace Tests\Unit\Policies;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_edit_users_profile()
    {
        $user = factory(User::class)->create();
        $manager = $user->manager;

        $this->assertTrue($manager->can('edit', $user));
    }
}
