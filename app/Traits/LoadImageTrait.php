<?php

namespace App\Traits;

trait LoadImageTrait
{
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
