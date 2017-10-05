<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_have_profile_link()
    {
        $user = factory(User::class)->create();
        $this->assertEquals(link_to_route('users.show', $user->nickname, [$user->id]), $user->profileLink());
    }

    /** @test */
    public function user_can_have_marriages()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife = factory(User::class)->states('female')->create();
        $husband->addWife($wife);

        $husband = $husband->fresh();
        $this->assertCount(1, $husband->wifes);
        $this->assertCount(1, $wife->husbands);
        $this->assertCount(1, $husband->marriages);
    }

    /** @test */
    public function user_can_ony_marry_same_person_once()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife = factory(User::class)->states('female')->create();

        $husband->addWife($wife);

        $this->assertFalse($wife->addHusband($husband), 'This couple is married!');
    }

    /** @test */
    public function user_have_father_link_method()
    {
        $father = factory(User::class)->create();
        $user = factory(User::class)->create(['father_id' => $father->id]);

        $this->assertEquals($father->profileLink(), $user->fatherLink());
    }

    /** @test */
    public function user_have_mother_link_method()
    {
        $mother = factory(User::class)->create();
        $user = factory(User::class)->create(['mother_id' => $mother->id]);

        $this->assertEquals($mother->profileLink(), $user->motherLink());
    }
}
