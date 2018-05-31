<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersDeletionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_delete_a_user()
    {
        $manager = $this->loginAsUser();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);

        $this->visit(route('users.edit', $user));
        $this->seeElement('a', ['id' => 'del-user-'.$user->id]);

        $this->click('del-user-'.$user->id);
        $this->seePageIs(route('users.edit', [$user, 'action' => 'delete']));
        $this->see(__('user.delete_confirm_button'));

        $this->press(__('user.delete_confirm_button'));

        $this->dontSeeInDatabase('users', [
            'id' => $user->id,
        ]);
    }
}
