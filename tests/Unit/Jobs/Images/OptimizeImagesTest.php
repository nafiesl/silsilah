<?php

namespace Tests\Unit\Jobs\Images;

use App\Jobs\Images\OptimizeImages;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OptimizeImagesTest extends TestCase
{
    /** @test */
    public function resize_image_into_a_proper_height()
    {
        Storage::fake(config('filesystem.default'));
        Storage::assertMissing('portrait_image.jpg');

        copy(storage_path('app/testing/portrait_image.jpg'), Storage::path('portrait_image.jpg'));
        dispatch(new OptimizeImages([Storage::path('portrait_image.jpg')]));

        Storage::assertExists('portrait_image.jpg');
    }

    /** @test */
    public function resize_image_into_a_proper_width()
    {
        Storage::fake(config('filesystem.default'));
        Storage::assertMissing('landscape_image.jpg');

        copy(storage_path('app/testing/landscape_image.jpg'), Storage::path('landscape_image.jpg'));
        dispatch(new OptimizeImages([Storage::path('landscape_image.jpg')]));

        Storage::assertExists('landscape_image.jpg');
    }
}
