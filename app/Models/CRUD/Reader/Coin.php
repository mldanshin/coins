<?php

namespace App\Models\CRUD\Reader;

use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\CRUD\Picture\Repository;
use App\Models\CRUD\Filters\Request\Coin as FilterRequest;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Ordering\Request as OrderingRequest;
use App\Models\Picture\Picture;
use App\Services\FileStorage;
use Illuminate\Pagination\LengthAwarePaginator;

final class Coin
{
    public function __construct(
        public readonly int $id,
        public readonly CoinTitle $title,
        public readonly string $country,
        public readonly string $nominal,
        public readonly string $coinage,
        public readonly string $material,
        public readonly string $currency,
        public readonly string $shape,
        public readonly string $theme,
        public readonly ?string $mintmark,
        public readonly string $year,
        public readonly string $quality,
        public readonly string $storage,
        public readonly Picture $picture,
        public readonly bool $isHasSeo,
        public readonly bool $isHasArticle,
    ) {
    }

    public static function getByEloquent(
        CoinEloquent $eloquent,
        LanguageType $lang,
        FileStorage $storage
    ): self {
        $nominal = $eloquent->nominal()->first()->value;
        $currency = $eloquent->currency()->first();

        return new self(
            $eloquent->id,
            new CoinTitle($nominal, $currency->id, $eloquent->year, $lang),
            $eloquent->country()->first()->translate($lang),
            $nominal,
            $eloquent->coinage()->first()->translate($lang),
            $eloquent->material()->first()->translate($lang),
            $currency->translate($lang),
            $eloquent->shape()->first()->translate($lang),
            $eloquent->theme()->first()->translate($lang),
            $eloquent->mintmark()->first()?->translate($lang),
            $eloquent->year,
            $eloquent->quality()->first()->translate($lang),
            $eloquent->storage()->first()->translate($lang),
            (new Repository($storage))->getReader($eloquent->id),
            ($eloquent->seo()->first() === null) ? false : true,
            ($eloquent->article()->first() === null) ? false : true
        );
    }

    /**
     * @return LengthAwarePaginator<Coin>
     */
    public static function getCollection(
        FilterRequest $filter,
        OrderingRequest $ordering,
        LanguageType $lang,
        FileStorage $storage
    ): LengthAwarePaginator {
        $paginator = CoinEloquent::search($filter, $ordering, $lang)->paginate(config("app.admin.paginate"));

        $coins = collect();
        $paginator->each(function ($value) use ($coins, $lang, $storage) {
            $coins->push(
                Coin::getByEloquent($value, $lang, $storage)
            );
        });
        $paginator->setCollection($coins);

        return $paginator;
    }
}
