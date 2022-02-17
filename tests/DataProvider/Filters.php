<?php
namespace Tests\DataProvider;

use App\Models\Filters\Request\Coin;
use App\Models\Filters\Request\Period;
use App\Models\Filters\Request\Search;
use App\Models\CRUD\Filters\Request\Coin as CoinCRUD;

trait Filters
{
    private function getRequestFilterEmpty(): Coin
    {
        return new Coin (
            new Search(""),
            new Period(null, null),
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            []
        );
    }

    private function getRequestFilterCRUDEmpty(): CoinCRUD
    {
        return new CoinCRUD (
            new Search(""),
            new Period(null, null),
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            []
        );
    }
}
