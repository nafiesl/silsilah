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
    public function manager_can_delete_a_user()
    {
        $manager = factory(User::class)->create();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);

        $this->assertTrue($manager->can('delete', $user));
    }
}
