<?php

namespace App\Models\Filters\Request;

final class Period
{
    public function __construct(
        public readonly ?string $first,
        public readonly ?string $last
    ) {
    }
}
