<?php

namespace App\Models\CRUD;

use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\CoinMintmark as CoinMintmarkEloquent;

final class CoinPreset
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
        public readonly ?int $storage
    ) {
    }

    public static function get(): self
    {
        return new self(
            session("coin_preset_country", config("app.coin_preset.country")),
            session("coin_preset_nominal", config("app.coin_preset.nominal")),
            session("coin_preset_coinage", config("app.coin_preset.coinage")),
            session("coin_preset_material", config("app.coin_preset.material")),
            session("coin_preset_currency", config("app.coin_preset.currency")),
            session("coin_preset_shape", config("app.coin_preset.shape")),
            session("coin_preset_theme", config("app.coin_preset.theme")),
            session("coin_preset_mintmark", config("app.coin_preset.mintmark")),
            session("coin_preset_year", config("app.coin_preset.year")),
            session("coin_preset_quality", config("app.coin_preset.quality")),
            session("coin_preset_storage", config("app.coin_preset.storage"))
        );
    }

    public static function save(self $coin): void
    {
        session(["coin_preset_country" => $coin->country]);
        session(["coin_preset_nominal" => $coin->nominal]);
        session(["coin_preset_coinage" => $coin->coinage]);
        session(["coin_preset_material" => $coin->material]);
        session(["coin_preset_currency" => $coin->currency]);
        session(["coin_preset_shape" => $coin->shape]);
        session(["coin_preset_theme" => $coin->theme]);
        session(["coin_preset_mintmark" => $coin->mintmark]);
        session(["coin_preset_year" => $coin->year]);
        session(["coin_preset_quality" => $coin->quality]);
        session(["coin_preset_storage" => $coin->storage]);
    }

    public static function reset(): void
    {
        session()->flush();
    }

    public static function old(): self
    {
        return new self(
            old("coin-country"),
            old("coin-nominal"),
            old("coin-coinage"),
            old("coin-material"),
            old("coin-currency"),
            old("coin-shape"),
            old("coin-theme"),
            old("coin-mintmark"),
            old("coin-year"),
            old("coin-quality"),
            old("coin-storage")
        );
    }
}
