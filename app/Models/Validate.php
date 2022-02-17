<?php

namespace App\Models;

use App\Exceptions\PageNotFoundException;
use App\Models\Eloquent\Coin as CoinEloquent;

final class Validate
{
    /**
    * @throws PageNotFoundException
    */
    public static function coinId(string $id): bool
    {
        $res = CoinEloquent::where("id", $id)->exists();
        if ($res !== true) {
            throw new PageNotFoundException("Coin id $id not found. ");
        }

        return true;
    }
}
