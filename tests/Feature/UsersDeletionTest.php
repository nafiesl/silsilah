<?php

namespace Tests\Feature;

use App\User;
use App\Couple;
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

    /** @test */
    public function manager_can_delete_a_user_the_replace_childs_father_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);
        $oldUserChild = factory(User::class)->create(['father_id' => $oldUser->id]);
        $replacementUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', $oldUser));
        $this->seeElement('a', ['id' => 'del-user-'.$oldUser->id]);

        $this->click('del-user-'.$oldUser->id);
        $this->seePageIs(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'father_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('users', [
            'id'        => $oldUserChild->id,
            'father_id' => $replacementUser->id,
        ]);
    }

    /** @test */
    public function manager_can_delete_a_user_the_replace_childs_mother_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = factory(User::class)->create([
            'gender_id'  => 2,
            'manager_id' => $manager->id,
        ]);
        $oldUserChild = factory(User::class)->create(['mother_id' => $oldUser->id]);
        $replacementUser = factory(User::class)->create([
            'gender_id'  => 2,
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', $oldUser));
        $this->seeElement('a', ['id' => 'del-user-'.$oldUser->id]);

        $this->click('del-user-'.$oldUser->id);
        $this->seePageIs(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'mother_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('users', [
            'id'        => $oldUserChild->id,
            'mother_id' => $replacementUser->id,
        ]);
    }

    /** @test */
    public function manager_can_delete_a_user_the_replace_users_manager_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);
        $oldUserManagedUser = factory(User::class)->create(['manager_id' => $oldUser->id]);
        $replacementUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', $oldUser));
        $this->seeElement('a', ['id' => 'del-user-'.$oldUser->id]);

        $this->click('del-user-'.$oldUser->id);
        $this->seePageIs(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'manager_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('users', [
            'id'         => $oldUserManagedUser->id,
            'manager_id' => $replacementUser->id,
        ]);
    }

    /** @test */
    public function manager_can_delete_a_user_the_replace_couples_husband_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);
        $oldUserCouple = factory(Couple::class)->create([
            'husband_id' => $oldUser->id,
        ]);
        $replacementUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('couples', [
            'husband_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('couples', [
            'id'         => $oldUserCouple->id,
            'husband_id' => $replacementUser->id,
        ]);
    }

    /** @test */
    public function manager_can_delete_a_user_the_replace_couples_wife_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = factory(User::class)->create([
            'gender_id'  => 2,
            'manager_id' => $manager->id,
        ]);
        $oldUserCouple = factory(Couple::class)->create([
            'wife_id' => $oldUser->id,
        ]);
        $replacementUser = factory(User::class)->create([
            'gender_id'  => 2,
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('couples', [
            'wife_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('couples', [
            'id'      => $oldUserCouple->id,
            'wife_id' => $replacementUser->id,
        ]);
    }

    /** @test */
    public function manager_can_delete_a_user_the_replace_couples_manager_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);
        $oldCoupleManagedCouple = factory(Couple::class)->create(['manager_id' => $oldUser->id]);
        $replacementUser = factory(User::class)->create([
            'gender_id'  => 1,
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('couples', [
            'manager_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('couples', [
            'id'         => $oldCoupleManagedCouple->id,
            'manager_id' => $replacementUser->id,
        ]);
    }
}
