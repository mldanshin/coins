<?php

namespace App\Models\CRUD\Creator;

use App\Models\CoinParameters;
use App\Models\CRUD\CoinPreset;

final class Coin
{
    public function __construct(
        public readonly ?int $country,
        public readonly ?int $nominal,
        public readonly ?int $coinage,
        public readonly ?int $material,
        public readonly ?int $currency,
        public readonly ?int $shape,
        public readonly ?int $theme,
        public readonly ?int $mintmark,
        public readonly ?string $year,
        public readonly ?int $quality,
        public readonly ?int $storage,
        public readonly CoinParameters $parameters,
    ) {
    }

    public static function getByPreset(
        CoinPreset $preset,
        CoinPreset $old,
        CoinParameters $parameters
    ): self {
        return new self(
            $old->country ?? $preset->country,
            $old->nominal ?? $preset->nominal,
            $old->coinage ?? $preset->coinage,
            $old->material ?? $preset->material,
            $old->currency ?? $preset->currency,
            $old->shape ?? $preset->shape,
            $old->theme ?? $preset->theme,
            $old->mintmark ?? $preset->mintmark,
            $old->year ?? $preset->year,
            $old->quality ?? $preset->quality,
            $old->storage ?? $preset->storage,
            $parameters
        );
    }
}
