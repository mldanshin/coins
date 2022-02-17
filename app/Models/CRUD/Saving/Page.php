<?php

namespace App\Models\CRUD\Saving;

use App\Models\Article;
use App\Models\LanguageType;
use App\Models\Seo;
use App\Models\CRUD\Picture\Repository as PictureRepository;
use App\Models\CRUD\Saving\Picture;
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

    public static function store(self $page, LanguageType $lang, FileStorage $storage): int
    {
        $coinId = DB::transaction(function () use ($page, $lang) {
            $coinId = Coin::store($page->coin);
            ($page->seo === null)
                ? Seo::delete($coinId)
                : Seo::storeOrUpdate($coinId, $page->seo, $lang);
            ($page->article === null)
                ? Article::delete($coinId)
                : Article::storeOrUpdate($coinId, $page->article, $lang);
            return $coinId;
        });

        (new PictureRepository($storage))->store($coinId, $page->picture);

        return $coinId;
    }
}
