<?php

namespace Tests\Feature;

use App\FamilyConnection;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
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
        $this->seeElement('button', ['id' => 'cancel_family_connection_request']);

        $this->seeInDatabase('family_connections', [
            'requester_id' => $user->id,
            'requested_id' => $otherPerson->id,
        ]);
    }

    /** @test */
    public function user_can_cancel_family_connection_request_to_other_user()
    {
        $user = $this->loginAsUser();
        $otherPerson = factory(User::class)->create();

        FamilyConnection::create([
            'id'           => Uuid::uuid4()->toString(),
            'requester_id' => $user->id,
            'requested_id' => $otherPerson->id,
        ]);

        $this->visitRoute('users.show', $otherPerson);
        $this->seeElement('button', ['id' => 'cancel_family_connection_request']);
        $this->press('cancel_family_connection_request');

        $this->dontSeeInDatabase('family_connections', [
            'requester_id' => $otherPerson->id,
            'requested_id' => $user->id,
        ]);
    }

    /** @test */
    public function user_can_accept_family_connection_request_from_other_user()
    {
        $user = $this->loginAsUser();
        $otherPerson = factory(User::class)->create();

        FamilyConnection::create([
            'id'           => Uuid::uuid4()->toString(),
            'requester_id' => $otherPerson->id,
            'requested_id' => $user->id,
        ]);

        $this->visitRoute('users.show', $otherPerson);
        $this->seeElement('button', ['id' => 'accept_family_connection_request']);
        $this->press('accept_family_connection_request');

        $this->seeRouteIs('users.show', $otherPerson);
        $this->seeInDatabase('family_connections', [
            'requester_id' => $otherPerson->id,
            'requested_id' => $user->id,
            'status_id'    => FamilyConnection::STATUS_APPROVED,
        ]);
    }

    /** @test */
    public function user_can_reject_family_connection_request_from_other_user()
    {
        $user = $this->loginAsUser();
        $otherPerson = factory(User::class)->create();

        FamilyConnection::create([
            'id'           => Uuid::uuid4()->toString(),
            'requester_id' => $otherPerson->id,
            'requested_id' => $user->id,
        ]);
        $this->seeInDatabase('family_connections', [
            'requester_id' => $otherPerson->id,
            'requested_id' => $user->id,
        ]);

        $this->visitRoute('users.show', $otherPerson);
        $this->seeElement('button', ['id' => 'reject_family_connection_request']);
        $this->press('reject_family_connection_request');

        $this->seeRouteIs('users.show', $otherPerson);
        $this->dontSeeInDatabase('family_connections', [
            'requester_id' => $otherPerson->id,
            'requested_id' => $user->id,
        ]);
    }
}
