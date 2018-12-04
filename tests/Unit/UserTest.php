<?php

namespace Tests\Unit;

use App\User;
use App\Couple;
use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    public function user_can_have_many_couples()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife = factory(User::class)->states('female')->create();
        $husband->addWife($wife);

        $husband = $husband->fresh();
        $this->assertCount(1, $husband->wifes);
        $this->assertCount(1, $wife->husbands);
        $this->assertCount(1, $husband->couples);
    }

    /** @test */
    public function user_can_have_many_marriages()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife = factory(User::class)->states('female')->create();
        $husband->addWife($wife);

        $husband = $husband->fresh();
        $this->assertCount(1, $husband->marriages);

        $wife = $wife->fresh();
        $this->assertCount(1, $wife->marriages);
    }

    /** @test */
    public function male_person_marriages_ordered_by_marriage_date()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife1 = factory(User::class)->states('female')->create();
        $wife2 = factory(User::class)->states('female')->create();
        $husband->addWife($wife2, '1999-04-21');
        $husband->addWife($wife1, '1990-02-13');

        $husband = $husband->fresh();
        $marriages = $husband->marriages;
        $this->assertEquals('1990-02-13', $marriages->first()->marriage_date);
        $this->assertEquals('1999-04-21', $marriages->last()->marriage_date);

        $this->assertEquals($wife1->name, $husband->couples->first()->name);
        $this->assertEquals($wife2->name, $husband->couples->last()->name);

        $this->assertEquals($wife1->name, $husband->wifes->first()->name);
        $this->assertEquals($wife2->name, $husband->wifes->last()->name);
    }

    /** @test */
    public function female_person_marriages_ordered_by_marriage_date()
    {
        $wife = factory(User::class)->states('female')->create();
        $husband1 = factory(User::class)->states('male')->create();
        $husband2 = factory(User::class)->states('male')->create();
        $wife->addHusband($husband2, '1989-04-21');
        $wife->addHusband($husband1, '1980-02-13');

        $wife = $wife->fresh();
        $marriages = $wife->marriages;
        $this->assertEquals('1980-02-13', $marriages->first()->marriage_date);
        $this->assertEquals('1989-04-21', $marriages->last()->marriage_date);

        $this->assertEquals($husband1->name, $wife->couples->first()->name);
        $this->assertEquals($husband2->name, $wife->couples->last()->name);

        $this->assertEquals($husband1->name, $wife->husbands->first()->name);
        $this->assertEquals($husband2->name, $wife->husbands->last()->name);
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

    /** @test */
    public function a_user_have_a_manager()
    {
        $manager = factory(User::class)->create();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);

        $this->assertTrue($user->manager instanceof User);
    }

    /** @test */
    public function a_user_has_many_managed_users_relation()
    {
        $user = factory(User::class)->create();
        $managedUser = factory(User::class)->create(['manager_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->managedUsers);
        $this->assertInstanceOf(User::class, $user->managedUsers->first());
    }

    /** @test */
    public function a_user_has_many_managed_couples_relation()
    {
        $user = factory(User::class)->create();
        $managedCouple = factory(Couple::class)->create(['manager_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->managedCouples);
        $this->assertInstanceOf(Couple::class, $user->managedCouples->first());
    }
}
