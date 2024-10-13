<?php

namespace App\Jobs\Images;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class OptimizeImages implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        //
    }
}
