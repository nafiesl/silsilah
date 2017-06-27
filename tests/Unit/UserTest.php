<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_have_profile_link()
    {
        $user = factory(User::class)->create();
        $this->assertEquals(link_to_route('users.show', $user->nickname, [$user->id]), $user->profileLink());
    }
}
