<?php

namespace App\Models;

use App\Models\LanguageType;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\Language as LanguageEloquent;
use App\Models\Eloquent\Seo as SeoEloquent;
use App\Models\Eloquent\SeoLanguage as SeoLanguageEloquent;

final class Seo
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $description,
        public readonly string $keywords
    ) {
    }

    public static function getByCoinEloquent(CoinEloquent $coinEloquent, LanguageType $lang): ?self
    {
        $seoEloquent = $coinEloquent->seo()->first()?->translate($lang);

        if ($seoEloquent === null) {
            return null;
        } else {
            return new Seo(
                $coinEloquent->seo()->first()->id,
                $seoEloquent->title,
                $seoEloquent->description,
                $seoEloquent->keywords
            );
        }
    }

    public static function getDefault(): self
    {
        return new self(
            0,
            __("page-index.title"),
            __("page-index.description"),
            __("page-index.keywords")
        );
    }

    public static function getEmpty(): self
    {
        return new self(0, "", "", "");
    }

    public static function storeOrUpdate(int $coinId, self $seo, LanguageType $lang): int
    {
        self::delete($coinId);

        $seoEloquent = SeoEloquent::create([
            "coin_id" => $coinId
        ]);

        SeoLanguageEloquent::create([
            "seo_id" => $seoEloquent->id,
            "language_id" => LanguageEloquent::getIdByType($lang),
            "title" => $seo->title,
            "description" => $seo->description,
            "keywords" => $seo->keywords
        ]);

        return $seoEloquent->id;
    }

    public static function delete(int $coinId): void
    {
        SeoEloquent::where("coin_id", $coinId)->delete();
    }
}
