<?php

namespace App\Models\Ordering;

final class Request
{
    public readonly int $value;

    public function __construct(
        ?int $value
    ) {
        $this->value = ($value === null) ? 2 : $value;
    }
}
