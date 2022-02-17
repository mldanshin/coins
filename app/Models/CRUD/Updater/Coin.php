<?php

namespace App\Models\CRUD\Updater;

use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\CoinMintmark as CoinMintmarkEloquent;

final class Coin
{
    public function __construct(
        public readonly int $id,
        public readonly int $country,
        public readonly int $nominal,
        public readonly int $coinage,
        public readonly int $material,
        public readonly int $currency,
        public readonly int $shape,
        public readonly int $theme,
        public readonly ?int $mintmark,
        public readonly string $year,
        public readonly int $quality,
        public readonly int $storage
    ) {
    }

    public static function update(self $coin): int
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

    public static function delete(int $id): void
    {
        CoinEloquent::find($id)->delete();
    }
}
