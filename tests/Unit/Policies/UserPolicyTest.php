<?php

namespace Tests\Unit\Policies;

use App\Couple;
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

    /** @test */
    public function father_can_edit_their_childs_profile()
    {
        $father = factory(User::class)->states('male')->create();
        $child = factory(User::class)->create(['father_id' => $father->id]);
        $otherUser = factory(User::class)->create();

        $this->assertTrue($father->can('edit', $child));
        $this->assertFalse($otherUser->can('edit', $child));
    }

    /** @test */
    public function mother_can_edit_their_childs_profile()
    {
        $mother = factory(User::class)->states('female')->create();
        $child = factory(User::class)->create(['mother_id' => $mother->id]);
        $otherUser = factory(User::class)->create();

        $this->assertTrue($mother->can('edit', $child));
        $this->assertFalse($otherUser->can('edit', $child));
    }

    /** @test */
    public function child_can_edit_their_fathers_profile()
    {
        $father = factory(User::class)->states('male')->create();
        $child = factory(User::class)->create(['father_id' => $father->id]);
        $otherUser = factory(User::class)->create();

        $this->assertTrue($child->can('edit', $father));
        $this->assertFalse($otherUser->can('edit', $father));
    }

    /** @test */
    public function child_can_edit_their_mothers_profile()
    {
        $mother = factory(User::class)->states('female')->create();
        $child = factory(User::class)->create(['mother_id' => $mother->id]);
        $otherUser = factory(User::class)->create();

        $this->assertTrue($child->can('edit', $mother));
        $this->assertFalse($otherUser->can('edit', $mother));
    }

    /** @test */
    public function husband_can_edit_their_wifes_profile()
    {
        $couple = factory(Couple::class)->create();
        $otherUser = factory(User::class)->create();

        $this->assertTrue($couple->husband->can('edit', $couple->husband->wifes->first()));
        $this->assertFalse($otherUser->can('edit', $couple->husband->wifes->first()));
    }

    /** @test */
    public function wife_can_edit_their_husbands_profile()
    {
        $couple = factory(Couple::class)->create();
        $otherUser = factory(User::class)->create();

        $this->assertTrue($couple->wife->can('edit', $couple->wife->husbands->first()));
        $this->assertFalse($otherUser->can('edit', $couple->wife->husbands->first()));
    }
}
