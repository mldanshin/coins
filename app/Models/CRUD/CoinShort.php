<?php

namespace App\Models\CRUD;

use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\CRUD\Picture\Repository;
use App\Models\CRUD\Filters\Request\Coin as FilterRequest;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Ordering\Request as OrderingRequest;
use App\Models\Picture\Picture;
use App\Services\FileStorage;
use Illuminate\Pagination\LengthAwarePaginator;

final class CoinShort
{
    public function __construct(
        public readonly int $id,
        public readonly CoinTitle $title,
        public readonly Picture $picture
    ) {
    }

    public static function getByEloquent(
        CoinEloquent $eloquent,
        LanguageType $lang,
        FileStorage $storage
    ): self {
        return new self(
            $eloquent->id,
            new CoinTitle(
                $eloquent->nominal()->first()->value,
                $eloquent->currency()->first()->id,
                $eloquent->year,
                $lang
            ),
            (new Repository($storage))->getReader($eloquent->id)
        );
    }

    /**
     * @return LengthAwarePaginator<CoinShort>
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
                CoinShort::getByEloquent($value, $lang, $storage)
            );
        });
        $paginator->setCollection($coins);

        return $paginator;
    }
}
