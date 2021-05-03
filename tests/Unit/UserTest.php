<?php

namespace Tests\Unit;

use App\Couple;
use App\User;
use App\UserMetadata;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Nonstandard\Uuid;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_have_profile_link()
    {
        $user = factory(User::class)->create();
        $this->assertEquals(link_to_route('users.show', $user->nickname, [$user->id]), $user->profileLink());
    }

    /** @test */
    public function user_can_have_many_couples()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife = factory(User::class)->states('female')->create();
        $husband->addWife($wife);

        $husband = $husband->fresh();
        $this->assertCount(1, $husband->wifes);
        $this->assertCount(1, $wife->husbands);
        $this->assertCount(1, $husband->couples);
    }

    /** @test */
    public function user_can_have_many_marriages()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife = factory(User::class)->states('female')->create();
        $husband->addWife($wife);

        $husband = $husband->fresh();
        $this->assertCount(1, $husband->marriages);

        $wife = $wife->fresh();
        $this->assertCount(1, $wife->marriages);
    }

    /** @test */
    public function male_person_marriages_ordered_by_marriage_date()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife1 = factory(User::class)->states('female')->create();
        $wife2 = factory(User::class)->states('female')->create();
        $husband->addWife($wife2, '1999-04-21');
        $husband->addWife($wife1, '1990-02-13');

        $husband = $husband->fresh();
        $marriages = $husband->marriages;
        $this->assertEquals('1990-02-13', $marriages->first()->marriage_date);
        $this->assertEquals('1999-04-21', $marriages->last()->marriage_date);

        $this->assertEquals($wife1->name, $husband->couples->first()->name);
        $this->assertEquals($wife2->name, $husband->couples->last()->name);

        $this->assertEquals($wife1->name, $husband->wifes->first()->name);
        $this->assertEquals($wife2->name, $husband->wifes->last()->name);
    }

    /** @test */
    public function female_person_marriages_ordered_by_marriage_date()
    {
        $wife = factory(User::class)->states('female')->create();
        $husband1 = factory(User::class)->states('male')->create();
        $husband2 = factory(User::class)->states('male')->create();
        $wife->addHusband($husband2, '1989-04-21');
        $wife->addHusband($husband1, '1980-02-13');

        $wife = $wife->fresh();
        $marriages = $wife->marriages;
        $this->assertEquals('1980-02-13', $marriages->first()->marriage_date);
        $this->assertEquals('1989-04-21', $marriages->last()->marriage_date);

        $this->assertEquals($husband1->name, $wife->couples->first()->name);
        $this->assertEquals($husband2->name, $wife->couples->last()->name);

        $this->assertEquals($husband1->name, $wife->husbands->first()->name);
        $this->assertEquals($husband2->name, $wife->husbands->last()->name);
    }

    /** @test */
    public function user_can_ony_marry_same_person_once()
    {
        $husband = factory(User::class)->states('male')->create();
        $wife = factory(User::class)->states('female')->create();

        $husband->addWife($wife);

        $this->assertFalse($wife->addHusband($husband), 'This couple is married!');
    }

    /** @test */
    public function user_have_father_link_method()
    {
        $father = factory(User::class)->create();
        $user = factory(User::class)->create(['father_id' => $father->id]);

        $this->assertEquals($father->profileLink(), $user->fatherLink());
    }

    /** @test */
    public function a_user_has_many_metadata_relation()
    {
        $user = factory(User::class)->create();
        $metadata = factory(UserMetadata::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->metadata);
        $this->assertInstanceOf(UserMetadata::class, $user->metadata->first());
    }

    /** @test */
    public function user_model_has_get_metadata_method()
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->getMetadata('cemetery_location_address'));

        DB::table('user_metadata')->insert([
            'id'      => Uuid::uuid4()->toString(),
            'user_id' => $user->id,
            'key'     => 'cemetery_location_address',
            'value'   => 'Some address',
        ]);
        $user = $user->fresh();

        $this->assertEquals('Some address', $user->getMetadata('cemetery_location_address'));
    }

    /** @test */
    public function user_model_get_metadata_method_returns_all_metadata_if_key_is_null()
    {
        $user = factory(User::class)->create();

        $this->assertEmpty($user->getMetadata());

        DB::table('user_metadata')->insert([
            'id'      => Uuid::uuid4()->toString(),
            'user_id' => $user->id,
            'key'     => 'cemetery_location_address',
            'value'   => 'Some address',
        ]);
        $user = $user->fresh();

        $this->assertCount(1, $user->getMetadata());
    }

    /** @test */
    public function user_model_get_metadata_method_accepts_a_default_value()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('Default value', $user->getMetadata('some_missing_key', 'Default value'));

        DB::table('user_metadata')->insert([
            'id'      => Uuid::uuid4()->toString(),
            'user_id' => $user->id,
            'key'     => 'some_missing_key',
            'value'   => 'Some value',
        ]);
        $user = $user->fresh();

        $this->assertEquals('Some value', $user->getMetadata('some_missing_key', 'Default value'));
    }

    /** @test */
    public function user_have_mother_link_method()
    {
        $mother = factory(User::class)->create();
        $user = factory(User::class)->create(['mother_id' => $mother->id]);

        $this->assertEquals($mother->profileLink(), $user->motherLink());
    }

    /** @test */
    public function a_user_have_a_manager()
    {
        $manager = factory(User::class)->create();
        $user = factory(User::class)->create(['manager_id' => $manager->id]);

        $this->assertTrue($user->manager instanceof User);
    }

    /** @test */
    public function a_user_has_many_managed_users_relation()
    {
        $user = factory(User::class)->create();
        $managedUser = factory(User::class)->create(['manager_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->managedUsers);
        $this->assertInstanceOf(User::class, $user->managedUsers->first());
    }

    /** @test */
    public function a_user_has_many_managed_couples_relation()
    {
        $user = factory(User::class)->create();
        $managedCouple = factory(Couple::class)->create(['manager_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->managedCouples);
        $this->assertInstanceOf(Couple::class, $user->managedCouples->first());
    }

    /**
     * @test
     * @dataProvider userAgeDataProvider
     */
    public function user_has_age_attribute($today, $dob, $yob, $dod, $yod, $age)
    {
        Carbon::setTestNow($today);
        $user = factory(User::class)->make([
            'dob' => $dob, 'yob' => $yob, 'dod' => $dod, 'yod' => $yod,
        ]);

        $this->assertEquals($age, $user->age);

        Carbon::setTestNow();
    }

    /**
     * Provide data for calculating user age.
     * Returning array of today, dob, yob, dod, yod, and age.
     *
     * @return array
     */
    public function userAgeDataProvider()
    {
        return [
            ['2018-02-02', '1997-01-01', '1997', null, null, 21],
            ['2018-02-02', '1997-01-01', null, null, null, 21],
            ['2018-02-02', null, '1997', null, null, 21],
            ['2018-02-02', '1997-01-01', '1997', '2017-01-01', '2017', 20],
            ['2018-02-02', null, '1997', null, '2017', 20],
        ];
    }

    /**
     * @test
     * @dataProvider userAgeDetailDataProvider
     */
    public function user_has_age_detail_attribute($today, $dob, $yob, $dod, $yod, $age)
    {
        Carbon::setTestNow($today);
        $user = factory(User::class)->make([
            'dob' => $dob, 'yob' => $yob, 'dod' => $dod, 'yod' => $yod,
        ]);

        $this->assertEquals($age, $user->age_detail);

        Carbon::setTestNow();
    }

    /**
     * Provide data for calculating user age detail.
     * Returning array of today, dob, yob, dod, yod, and age.
     *
     * @return array
     */
    public function userAgeDetailDataProvider()
    {
        return [
            ['2018-02-02', '1997-01-01', '1997', null, null, '21 tahun, 1 bulan, 1 hari'],
            ['2018-02-02', '1997-01-01', null, null, null, '21 tahun, 1 bulan, 1 hari'],
            ['2018-02-02', null, '1997', null, null, '21 tahun'],
            ['2018-02-02', '1997-01-01', '1997', '2017-01-01', '2017', '20 tahun'],
            ['2018-02-02', null, '1997', null, '2017', '20 tahun'],
        ];
    }

    /** @test */
    public function user_has_age_string_attribute()
    {
        $today = '2018-02-02';
        Carbon::setTestNow($today);
        $user = factory(User::class)->make(['dob' => '1997-01-01']);

        $ageString = '<div title="21 tahun, 1 bulan, 1 hari">21 tahun</div>';
        $this->assertEquals($ageString, $user->age_string);

        Carbon::setTestNow();
    }

    /** @test */
    public function a_user_has_birthday_attribute()
    {
        $dateOfBirth = '1990-01-01';

        $customer = factory(User::class)->create(['dob' => $dateOfBirth]);

        $birthdayDate = date('Y').substr($dateOfBirth, 4);
        $birthdayDateClass = Carbon::parse($birthdayDate);

        if (Carbon::parse(date('Y-m-d').' 00:00:00')->gt($birthdayDateClass)) {
            $currentYearBirthday = $birthdayDateClass->addYear();
        } else {
            $currentYearBirthday = $birthdayDateClass;
        }

        $this->assertEquals($currentYearBirthday, $customer->birthday);
    }

    /** @test */
    public function a_user_has_birthday_remaining_attribute()
    {
        $dateOfBirth = '1990-01-01';

        $customer = factory(User::class)->create(['dob' => $dateOfBirth]);

        $birthdayDate = date('Y').substr($dateOfBirth, 4);
        $birthdayDateClass = Carbon::parse($birthdayDate);

        if (Carbon::now()->gt($birthdayDateClass)) {
            $currentYearBirthday = $birthdayDateClass->addYear()->format('Y-m-d');
        } else {
            $currentYearBirthday = $birthdayDateClass->format('Y-m-d');
        }

        $this->assertEquals(
            Carbon::now()->diffInDays($birthdayDateClass, false),
            $customer->birthday_remaining
        );
    }
}
