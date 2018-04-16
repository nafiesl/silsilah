<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CouplePivot extends Pivot
{
    protected $casts = [
        'id' => 'string',
    ];
}
