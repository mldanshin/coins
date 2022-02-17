<?php

namespace App\Models\Picture;

final class Picture
{
    public function __construct(
        public readonly int $coinId,
        public readonly string $description,
        public readonly ?string $obverse,
        public readonly ?string $reverse,
        public readonly string $default
    ) {
    }
}
