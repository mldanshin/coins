<?php

namespace App\Models\CRUD\Saving;

use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\CoinMintmark as CoinMintmarkEloquent;

final class Coin
{
    public function __construct(
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

    public static function store(self $coin): int
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
                "coin_id" => $eloquent->id,
                "mintmark_id" => $coin->mintmark
            ]);
        }

        return $eloquent->id;
    }
}
