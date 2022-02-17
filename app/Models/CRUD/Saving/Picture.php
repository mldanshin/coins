<?php

namespace App\Models\CRUD\Saving;

final class Picture
{
    public function __construct(
        public readonly ?string $obverse,
        public readonly ?string $reverse,
    ) {
    }
}
