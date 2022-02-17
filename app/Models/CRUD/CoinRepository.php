<?php

namespace App\Models\CRUD;

use App\Models\CRUD\Saving\Coin as CoinSaving;
use App\Models\CRUD\Updater\Coin as CoinUpdater;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\CoinMintmark as CoinMintmarkEloquent;

final class CoinRepository
{
    public function store(CoinSaving $coin): int
    {
        $eloquent = CoinEloquent::create([
            "country_id" => $coin->country,
            "nominal_id" => $coin->nominal,
            "coinage_id" => $coin->coinage,
            "material_id" => $coin->material,
            "currency_id" => $coin->currency,
            "shape_id" => $coin->shape,
            "theme_id" => $coin->theme,
            "year" => $coin->year,
            "quality_id" => $coin->quality,
            "storage_id" => $coin->storage
        ]);

        if ($coin->mintmark !== null) {
            CoinMintmarkEloquent::create([
                "coin_id" => $coin->id,
                "mintmark_id" => $coin->mintmark
            ]);
        }

        return $eloquent->id;
    }

    public function update(CoinUpdater $coin): int
    {
        $eloquent = CoinEloquent::find($coin->id);
        $eloquent->country_id = $coin->country;
        $eloquent->nominal_id = $coin->nominal;
        $eloquent->coinage_id = $coin->coinage;
        $eloquent->material_id = $coin->material;
        $eloquent->currency_id = $coin->currency;
        $eloquent->shape_id = $coin->shape;
        $eloquent->theme_id = $coin->theme;
        $eloquent->year = $coin->year;
        $eloquent->quality_id = $coin->quality;
        $eloquent->storage_id = $coin->storage;
        $eloquent->save();

        CoinMintmarkEloquent::where("coin_id", $coin->id)->delete();
        if ($coin->mintmark !== null) {
            CoinMintmarkEloquent::create([
                "coin_id" => $coin->id,
                "mintmark_id" => $coin->mintmark
            ]);
        }

        return $coin->id;
    }

    public function delete(int $id): void
    {
        CoinEloquent::find($id)->delete();
    }
}
