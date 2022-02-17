<?php

namespace App\Models\CRUD\Editor;

use App\Models\CoinParameters;
use App\Models\CRUD\CoinPreset;
use App\Models\CRUD\Picture\Repository;
use App\Models\CRUD\Editor\Picture\Picture;
use App\Services\FileStorage;
use App\Models\Eloquent\Coin as CoinEloquent;

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
        public readonly int $storage,
        public readonly CoinParameters $parameters,
        public readonly Picture $picture
    ) {
    }

    public static function getByEloquent(
        CoinEloquent $eloquent,
        CoinPreset $old,
        CoinParameters $parameters,
        FileStorage $storage
    ): self {
        return new self(
            $eloquent->id,
            $old->country ?? $eloquent->country_id,
            $old->nominal ?? $eloquent->nominal_id,
            $old->coinage ?? $eloquent->coinage_id,
            $old->material ?? $eloquent->material_id,
            $old->currency ?? $eloquent->currency_id,
            $old->shape ?? $eloquent->shape_id,
            $old->theme ?? $eloquent->theme_id,
            $old->mintmark ?? $eloquent->mintmark()->first()?->id,
            $old->year ?? $eloquent->year,
            $old->quality ?? $eloquent->quality_id,
            $old->storage ?? $eloquent->storage_id,
            $parameters,
            (new Repository($storage))->getEditor($eloquent->id)
        );
    }
}
