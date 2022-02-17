<?php

namespace App\Models;

use App\Models\LanguageType;
use App\Models\Eloquent\Article as ArticleEloquent;
use App\Models\Eloquent\ArticleLanguage as ArticleLanguageEloquent;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\Language as LanguageEloquent;

final class Article
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $content
    ) {
    }

    public static function getByCoinEloquent(CoinEloquent $coinEloquent, LanguageType $lang): ?self
    {
        $articleEloquent = $coinEloquent->article()->first()?->translate($lang);

        if ($articleEloquent === null) {
            return null;
        } else {
            return new Article(
                $coinEloquent->article()->first()->id,
                $articleEloquent->title,
                $articleEloquent->content
            );
        }
    }

    public static function getEmpty(): self
    {
        return new self(0, "", "");
    }

    public static function storeOrUpdate(int $coinId, self $article, LanguageType $lang): int
    {
        self::delete($coinId);

        $articleEloquent = ArticleEloquent::create([
            "coin_id" => $coinId
        ]);

        ArticleLanguageEloquent::create([
            "article_id" => $articleEloquent->id,
            "language_id" => LanguageEloquent::getIdByType($lang),
            "title" => $article->title,
            "content" => $article->content
        ]);

        return $articleEloquent->id;
    }

    public static function delete(int $coinId): void
    {
        ArticleEloquent::where("coin_id", $coinId)->delete();
    }
}
