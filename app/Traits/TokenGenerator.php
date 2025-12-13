<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait TokenGenerator
{
    /**
     * * @return string
     */
    protected function generateUniqueToken(): string
    {
        return Str::uuid()->toString();
    }
}