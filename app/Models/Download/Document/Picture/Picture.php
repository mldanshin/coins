<?php

namespace App\Models\Download\Document\Picture;

final class Picture
{
    public function __construct(
        public readonly ?string $obverse,
        public readonly ?string $reverse
    ) {
    }
}
