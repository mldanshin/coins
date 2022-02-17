<?php

namespace App\Models;

use App\Models\Eloquent\Coin as CoinEloquent;
use App\Services\FileStorage;

final class PageShow extends PageBase
{
    public function __construct(
        LanguageType $languageType,
        public readonly Seo $seo,
        public readonly Coin $coin,
        public readonly ?Article $article
    ) {
        parent::__construct($languageType);
    }

    public static function create(int $coinId, LanguageType $lang, FileStorage $storage): self
    {
        $coinEloquent = CoinEloquent::find($coinId);

        return new self(
            $lang,
            Seo::getByCoinEloquent($coinEloquent, $lang) ?? Seo::getDefault(),
            Coin::getByEloquent($coinEloquent, $lang, $storage),
            Article::getByCoinEloquent($coinEloquent, $lang)
        );
    }
}
