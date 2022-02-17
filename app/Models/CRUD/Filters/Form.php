<?php

namespace App\Models\CRUD\Filters;

use App\Models\CoinParameters;
use App\Models\CRUD\Filters\Request\Coin;

final class Form
{
    public function __construct(
        public readonly CoinParameters $parameters,
        public readonly Coin $values,
    ) {
    }
}
