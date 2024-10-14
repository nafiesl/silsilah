<?php

namespace App\Jobs\Images;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\Laravel\Facades\Image;

class OptimizeImages implements ShouldQueue
{
    use Dispatchable, Queueable;

    private $imagePaths;

    public function __construct(array $imagePaths)
    {
        $this->imagePaths = $imagePaths;
    }

    public function handle()
    {
        $convertedImagesCount = 0;
        foreach ($this->imagePaths as $imagePath) {
            $image = Image::read($imagePath);
            $image->scale(1000, 1000);
            $image->save();
        }
    }
}
