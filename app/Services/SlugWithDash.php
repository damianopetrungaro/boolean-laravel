<?php


namespace App\Services;

use Illuminate\Support\Str;

class SlugWithDash
{
    public function __invoke(string $name): string
    {
        return Str::slug($name);
    }
}
