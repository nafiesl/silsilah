<?php

namespace Tests\Unit\Policies;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_edit_users_profile()
    {
        $otherUserManagerId = Str::random();
        $manager = factory(User::class)->create();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);
        $otherUser = factory(User::class)->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($manager->can('edit', $user));
        $this->assertFalse($manager->can('edit', $otherUser));
    }

    /** @test */
    public function admins_can_edit_any_user_profile()
    {
        $adminEmail = 'admin@example.net';
        $otherUserManagerId = Str::random();
        config(['app.system_admin_emails' => $adminEmail]);

        $manager = factory(User::class)->create();
        $admin = factory(User::class)->create(['email' => $adminEmail]);
        $user = factory(User::class)->create(['manager_id' => $manager->id]);
        $otherUser = factory(User::class)->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($admin->can('edit', $user));
        $this->assertTrue($admin->can('edit', $otherUser));

        $this->assertTrue($manager->can('edit', $user));
        $this->assertFalse($manager->can('edit', $otherUser));
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
        $otherUserManagerId = Str::random();
        $manager = factory(User::class)->create();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);
        $otherUser = factory(User::class)->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($manager->can('delete', $user));
        $this->assertFalse($manager->can('delete', $otherUser));
    }

    /** @test */
    public function admins_can_delete_any_user()
    {
        $adminEmail = 'admin@example.net';
        $otherUserManagerId = Str::random();
        config(['app.system_admin_emails' => $adminEmail]);

        $manager = factory(User::class)->create();
        $admin = factory(User::class)->create(['email' => $adminEmail]);
        $user = factory(User::class)->create(['manager_id' => $manager->id]);
        $otherUser = factory(User::class)->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($admin->can('delete', $user));
        $this->assertTrue($admin->can('delete', $otherUser));

        $this->assertTrue($manager->can('delete', $user));
        $this->assertFalse($manager->can('delete', $otherUser));
    }

    /** @test */
    public function user_cannot_delete_their_own_data()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->can('delete', $user));
    }
}
