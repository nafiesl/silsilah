<?php

namespace Tests\Unit\Policies;

use App\Couple;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CouplePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_edit_couple_data()
    {
        $couple = factory(Couple::class)->create();
        $manager = $couple->manager;

        $this->assertTrue($manager->can('edit', $couple));
    }
}
