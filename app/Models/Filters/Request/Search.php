<?php

namespace App\Models\Filters\Request;

final class Search
{
    public function __construct(
        public readonly string $value
    ) {
    }
}
