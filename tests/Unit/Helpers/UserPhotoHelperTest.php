<?php

namespace Tests\Unit\Helpers;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPhotoHelperTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_photo_path_function_exists()
    {
        $this->assertTrue(function_exists('userPhotoPath'));
    }

    /** @test */
    public function user_photo_path_function_returns_default_photo_path_based_on_gender_if_photo_path_is_null()
    {
        $genderId = 1; // Male
        $this->assertEquals(
            asset('images/icon_user_1.png'), userPhotoPath(null, $genderId)
        );

        $genderId = 2; // Female
        $this->assertEquals(
            asset('images/icon_user_2.png'), userPhotoPath(null, $genderId)
        );
    }
    /** @test */
    public function user_photo_function_exists()
    {
        $this->assertTrue(function_exists('userPhoto'));
    }

    /** @test */
    public function user_photo_function_returns_default_image_photo_element_if_no_agency_image_path_setting()
    {
        $user = factory(User::class)->create(['gender_id' => 1]);

        $photoFile = 'images/icon_user_1.png';

        $imageString = '<img';
        $imageString .= ' src="'.asset($photoFile).'"';
        $imageString .= '>';

        $this->assertEquals($imageString, userPhoto($user));
    }

    /** @test */
    public function user_photo_function_returns_correct_photo_element_based_on_user_photo_path()
    {
        $photoPath = 'images/user_photo_path.jpg';

        if (!is_dir(storage_path('app/public/images'))) {
            mkdir(storage_path('app/public/images'), 0700);
        }
        copy(public_path('images/icon_user_1.png'), storage_path('app/public/images/user_photo_path.jpg'));

        $this->assertFileExists(storage_path('app/public/images/user_photo_path.jpg'));

        $user = factory(User::class)->create([
            'gender_id'  => 2,
            'photo_path' => $photoPath,
        ]);

        $imageString = '<img';
        $imageString .= ' src="'.asset('storage/'.$photoPath).'"';
        $imageString .= '>';

        $this->assertEquals($imageString, userPhoto($user));

        $this->assertFileExists(storage_path('app/public/images/user_photo_path.jpg'));
        unlink(storage_path('app/public/images/user_photo_path.jpg'));
        $this->assertFileDoesNotExist(storage_path('app/public/images/user_photo_path.jpg'));
    }

    /** @test */
    public function user_photo_function_has_overrideable_attributes()
    {
        $user = factory(User::class)->create([
            'gender_id' => 1,
        ]);

        $photoFile = 'images/icon_user_1.png';

        $imageString = '<img';
        $imageString .= ' src="'.asset($photoFile).'"';
        $imageString .= ' class="123"';
        $imageString .= ' style="display: inline"';
        $imageString .= '>';

        $overrides = [
            'class' => '123',
            'style' => 'display: inline',
        ];
        $this->assertEquals($imageString, userPhoto($user, $overrides));
    }

    /** @test */
    public function user_photo_function_returns_default_gender_logo_image_if_user_photo_file_doesnt_exists()
    {
        $user = factory(User::class)->create([
            'gender_id'  => 2,
            'photo_path' => 'images/non_exists_photo_path.jpg',
        ]);

        $photoFile = 'images/icon_user_2.png';

        $imageString = '<img';
        $imageString .= ' src="'.asset($photoFile).'"';
        $imageString .= '>';

        $this->assertEquals($imageString, userPhoto($user));
    }
}
