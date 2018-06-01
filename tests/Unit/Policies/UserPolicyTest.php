<?php

namespace Tests\Unit\Policies;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_edit_users_profile()
    {
        $manager = factory(User::class)->create();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);

        $this->assertTrue($manager->can('edit', $user));
    }

    /** @test */
    public function user_can_edit_their_own_profile()
    {
        $user = factory(User::class)->create();

        $this->assertTrue($user->can('edit', $user));
    }

    /** @test */
    public function manager_can_delete_a_user()
    {
        $manager = factory(User::class)->create();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);

        $this->assertTrue($manager->can('delete', $user));
    }

    /** @test */
    public function user_cannot_delete_their_own_data()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->can('delete', $user));
    }
}
