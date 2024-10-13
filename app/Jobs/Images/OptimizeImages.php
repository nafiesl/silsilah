<?php

namespace App\Jobs\Images;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        dump($this->imagePaths);
    }
}
