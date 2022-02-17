<?php

namespace App\Models;

final class ItemCollection
{
    public function __construct(
        public readonly int|string $id,
        public readonly string $name
    ) {
    }
}
