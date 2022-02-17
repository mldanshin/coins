<?php

namespace App\Models;

use App\Models\LanguageType;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Filters\Request\Coin as FilterRequest;
use App\Models\Ordering\Request as OrderingRequest;
use App\Models\Picture\Picture;
use App\Models\Picture\Repository;
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
        public readonly string $year,
        public readonly Picture $picture
    ) {
    }

    public static function getByEloquent(
        CoinEloquent $eloquent,
        LanguageType $lang,
        FileStorage $storage
    ): self {
        $country = $eloquent->country()->first()->translate($lang);
        $nominal = $eloquent->nominal()->first()->value;

        $currency = $eloquent->currency()->first();
        $currencyName = $currency->translate($lang);

        return new self(
            $eloquent->id,
            new CoinTitle(
                $nominal,
                $currency->id,
                $eloquent->year,
                $lang
            ),
            $country,
            $nominal,
            $eloquent->coinage()->first()->translate($lang),
            $eloquent->material()->first()->translate($lang),
            $currencyName,
            $eloquent->shape()->first()->translate($lang),
            $eloquent->theme()->first()->translate($lang),
            $eloquent->year,
            (new Repository($storage))->get(
                $eloquent->id,
                $country,
                $nominal,
                $currencyName,
                $eloquent->year
            )
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
        $paginator = CoinEloquent::search($filter, $ordering, $lang)->paginate(config("app.front.paginate"));

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
