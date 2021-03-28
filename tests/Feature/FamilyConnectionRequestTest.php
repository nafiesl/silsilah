<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamilyConnectionRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_send_family_connection_request_to_other_user()
    {
        $user = $this->loginAsUser();
        $otherPerson = factory(User::class)->create();

        $this->dontSeeInDatabase('family_connections', [
            'requester_id' => $user->id,
            'requested_id' => $otherPerson->id,
        ]);

        $this->visitRoute('users.show', $otherPerson);
        $this->seeElement('button', ['id' => 'send_family_connection_request']);
        $this->press('send_family_connection_request');
        $this->seeRouteIs('users.show', $otherPerson);

        $this->seeInDatabase('family_connections', [
            'requester_id' => $user->id,
            'requested_id' => $otherPerson->id,
        ]);
    }
}
