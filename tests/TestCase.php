<?php

namespace Tests;

use App\User;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $baseUrl = 'http://localhost';

    protected function loginAsUser($overrides = [])
    {
        $userId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $overrides = array_merge([
            'id'         => $userId,
            'manager_id' => $userId,
        ], $overrides);

        $user = factory(User::class)->create($overrides);
        $this->actingAs($user);

        return $user;
    }
}
