<?php

namespace App\Models\CRUD\Updater;

use App\Models\Article;
use App\Models\LanguageType;
use App\Models\Seo;
use App\Models\CRUD\Picture\Repository as PictureRepository;
use App\Models\CRUD\Updater\Picture;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Services\FileStorage;
use Illuminate\Support\Facades\DB;

final class Page
{
    public function __construct(
        public readonly Coin $coin,
        public readonly Picture $picture,
        public readonly ?Seo $seo,
        public readonly ?Article $article
    ) {
    }

    public static function update(self $page, LanguageType $lang, FileStorage $storage): int
    {
        $coinId = DB::transaction(function () use ($page, $lang) {
            $coinId = Coin::update($page->coin);
            ($page->seo === null)
                ? Seo::delete($coinId)
                : Seo::storeOrUpdate($coinId, $page->seo, $lang);
            ($page->article === null)
                ? Article::delete($coinId)
                : Article::storeOrUpdate($coinId, $page->article, $lang);
            return $coinId;
        });

        (new PictureRepository($storage))->update($page->picture);

        return $coinId;
    }

    public static function delete(int $coinId, FileStorage $storage): void
    {
        Coin::delete($coinId);
        (new PictureRepository($storage))->delete($coinId);
    }
}
