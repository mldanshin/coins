<?php

namespace App\Models\Filters;

use App\Models\CoinParameters;
use App\Models\Filters\Request\Coin;

final class Form
{
    public function __construct(
        public readonly CoinParameters $parameters,
        public readonly Coin $values,
    ) {
    }
}
