<?php

namespace Tests\Unit\Jobs\Images;

use App\Jobs\Images\OptimizeImages;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OptimizeImagesTest extends TestCase
{
    /** @test */
    public function resize_image_into_a_proper_width()
    {
        Storage::fake(config('filesystem.default'));
        // dump(file_exists(Storage::path('images/portrait_image.jpg')));
        // dd(storage_path('app/testing/portrait_image.jpg'));
        Storage::assertMissing('portrait_image.jpg');
        copy(storage_path('app/testing/portrait_image.jpg'), Storage::path('portrait_image.jpg'));
        // dump(file_exists(Storage::path('portrait_image.jpg')));
        dispatch(new OptimizeImages([Storage::path('portrait_image.jpg')]));
        // dump(file_exists(Storage::path('portrait_image.jpg')));
        Storage::assertExists('portrait_image.jpg');

    }
}
