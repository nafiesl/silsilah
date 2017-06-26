<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PersonRelationsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function create_user_model_with_factory()
    {
        $person = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
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

        $this->assertDatabaseHas('users', [
            'id' => $person->id,
            'father_id' => $father->id,
        ]);
    }

    /** @test */
    public function person_can_have_a_mother()
    {
        $person = factory(User::class)->create();
        $mother = factory(User::class)->states('female')->create();
        $person->setMother($mother);

        $this->assertDatabaseHas('users', [
            'id' => $person->id,
            'mother_id' => $mother->id,
        ]);
    }
}
