<?php

namespace App\Models\CRUD\Updater;

final class Picture
{
    public function __construct(
        public readonly int $coinId,
        public readonly ?string $obverse,
        public readonly ?string $reverse,
    ) {
    }
}
