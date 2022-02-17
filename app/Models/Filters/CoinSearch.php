<?php

namespace App\Models\Filters;

use App\Models\Eloquent\Coin;

final class CoinSearch implements Searchable
{
    use SearchBase;

    private const MODEL = Coin::class;
}
