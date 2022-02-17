<?php

namespace App\Models\CRUD\Editor\Picture;

final class Picture
{
    public function __construct(
        public readonly int $coinId,
        public readonly ?Source $obverse,
        public readonly ?Source $reverse
    ) {
    }
}
