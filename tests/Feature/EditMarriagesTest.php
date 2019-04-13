<?php

namespace Tests\Feature;

use App\Couple;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditMarriagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_visit_a_marriage_detail_page()
    {
        $couple = factory(Couple::class)->create();

        $this->visit(route('couples.show', $couple));

        $this->see($couple->husband->name);
        $this->see($couple->wife->name);
    }

    /** @test */
    public function manager_can_edit_couple_data()
    {
        $user = $this->loginAsUser();
        $couple = factory(Couple::class)->create(['manager_id' => $user->id]);

        $this->visit(route('couples.show', $couple));

        $this->click(trans('couple.edit'));
        $this->seePageIs(route('couples.edit', $couple));

        $this->submitForm(trans('couple.update'), [
            'marriage_date' => '2010-04-04',
            'divorce_date'  => '2035-04-04',
        ]);

        $this->seePageIs(route('couples.show', $couple));

        $this->seeInDatabase('couples', [
            'id'            => $couple->id,
            'marriage_date' => '2010-04-04',
            'divorce_date'  => '2035-04-04',
        ]);
    }
}
