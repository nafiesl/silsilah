<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonRelationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_user_model_with_factory()
    {
        $person = factory(User::class)->create();

        $this->seeInDatabase('users', [
            'nickname' => $person->nickname,
            'gender_id' => $person->gender_id,
        ]);
    }

    /** @test */
    public function person_can_have_a_father()
    {
        $person = factory(User::class)->create();
        $father = factory(User::class)->states('male')->create();
        $person->setFather($father);

        $this->seeInDatabase('users', [
            'id' => $person->id,
            'father_id' => $father->id,
        ]);

        $this->assertEquals($father->name, $person->father->name);
    }

    /** @test */
    public function person_can_have_a_mother()
    {
        $person = factory(User::class)->create();
        $mother = factory(User::class)->states('female')->create();
        $person->setMother($mother);

        $this->seeInDatabase('users', [
            'id' => $person->id,
            'mother_id' => $mother->id,
        ]);

        $this->assertEquals($mother->name, $person->mother->name);
    }

    /** @test */
    public function person_can_many_childs()
    {
        $mother = factory(User::class)->states('female')->create();
        $person = factory(User::class)->create();
        $person->setMother($mother);
        $person = factory(User::class)->create();
        $person->setMother($mother);

        $this->assertCount(2, $mother->childs);
    }
}
