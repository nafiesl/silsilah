<?php

namespace Tests\Feature;

use Storage;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_other_users_profile()
    {
        $user = factory(User::class)->create();
        $this->visit(route('users.show', $user->id));
        $this->see($user->name);
    }

    /** @test */
    public function user_can_edit_profile()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', $user->id));
        $this->seePageIs(route('users.edit', $user->id));

        $this->submitForm(trans('app.update'), [
            'nickname'  => 'Nama Panggilan',
            'name'      => 'Nama User',
            'gender_id' => 1,
            'dob'       => '1959-06-09',
            'dod'       => '2003-10-17',
            'yod'       => '',
            'address'   => 'Jln. Angkasa, No. 70',
            'city'      => 'Nama Kota',
            'phone'     => '081234567890',
            'email'     => '',
            'password'  => '',
        ]);

        $this->seeInDatabase('users', [
            'nickname'  => 'Nama Panggilan',
            'name'      => 'Nama User',
            'gender_id' => 1,
            'dob'       => '1959-06-09',
            'dod'       => '2003-10-17',
            'yod'       => '2003',
            'address'   => 'Jln. Angkasa, No. 70',
            'city'      => 'Nama Kota',
            'phone'     => '081234567890',
            'email'     => null,
            'password'  => null,
        ]);
    }

    /** @test */
    public function manager_can_add_login_account_on_a_user()
    {
        $manager = $this->loginAsUser();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);
        $this->visit(route('users.edit', $user->id));
        $this->seePageIs(route('users.edit', $user->id));

        $this->submitForm(trans('app.update'), [
            'email'    => 'user@mail.com',
            'password' => 'Secr3t',
        ]);

        $user = $user->fresh();
        $this->assertEquals('user@mail.com', $user->email);
        $this->assertTrue(app('hash')->check('Secr3t', $user->password));
    }

    /** @test */
    public function manager_can_add_user_email_without_a_password()
    {
        $manager = $this->loginAsUser();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);
        $this->visit(route('users.edit', $user->id));
        $this->seePageIs(route('users.edit', $user->id));

        $this->submitForm(trans('app.update'), [
            'email'    => 'user@mail.com',
            'password' => '',
        ]);

        $user = $user->fresh();
        $this->assertEquals('user@mail.com', $user->email);
        $this->assertNull($user->password);
    }

    /** @test */
    public function user_can_upload_their_own_photo()
    {
        Storage::fake('avatars');

        $user = $this->loginAsUser();
        $this->visit(route('users.edit', $user->id));
        $this->assertNull($user->photo_path);

        $this->attach(public_path('images/icon_user_1.png'), 'photo');
        $this->press(trans('user.update_photo'));

        $this->seePageIs(route('users.edit', $user));

        $user = $user->fresh();

        $this->assertNotNull($user->photo_path);
        Storage::disk('avatars')->assertExists($user->photo_path);
    }

    /** @test */
    public function guest_can_search_users_profile()
    {
        $this->visit(route('users.search'));
        $this->seePageIs(route('users.search'));
    }
}
