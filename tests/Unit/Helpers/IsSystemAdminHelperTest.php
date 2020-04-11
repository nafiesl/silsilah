<?php

namespace Tests\Unit\Helpers;

use App\User;
use Tests\TestCase;

class IsSystemAdminHelperTest extends TestCase
{
    /** @test */
    public function user_is_an_admin()
    {
        $adminEmail1 = 'admin1@example.net';
        $adminEmail2 = 'admin2@example.net';
        putenv('SYSTEM_ADMIN_EMAILS='.$adminEmail1.';'.$adminEmail2);

        $admin1 = factory(User::class)->make(['email' => $adminEmail1]);
        $admin2 = factory(User::class)->make(['email' => $adminEmail2]);
        $userWithEmail = factory(User::class)->make(['email' => 'user@example.net']);
        $userWithNoEmail = factory(User::class)->make(['email' => null]);

        $this->assertTrue(is_system_admin($admin1));
        $this->assertTrue(is_system_admin($admin2));
        $this->assertFalse(is_system_admin($userWithEmail));
        $this->assertFalse(is_system_admin($userWithNoEmail));
    }
}
