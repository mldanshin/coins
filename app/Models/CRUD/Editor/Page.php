<?php

namespace App\Models\CRUD\Editor;

use App\Models\Article;
use App\Models\CoinParameters;
use App\Models\LanguageType;
use App\Models\Seo;
use App\Models\CRUD\CoinPreset;
use App\Models\CRUD\CoinShort;
use App\Models\CRUD\Filters\Form as FiltersForm;
use App\Models\CRUD\Filters\Request\Coin as FilterRequest;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\Ordering;
use App\Models\Ordering\Form as OrderingForm;
use App\Models\Ordering\Request as OrderingRequest;
use App\Services\FileStorage;
use Illuminate\Pagination\LengthAwarePaginator;

final class Page
{
    /**
     * @param LengthAwarePaginator<CoinShort> $coins
     */
    public function __construct(
        public readonly LengthAwarePaginator $coins,
        public readonly Coin $coin,
        public readonly ?Seo $seo,
        public readonly ?Article $article,
        public readonly FiltersForm $filtersForm,
        public readonly OrderingForm $orderingForm
    ) {
    }

    public static function create(
        FilterRequest $filter,
        OrderingRequest $ordering,
        int $coinId,
        LanguageType $lang,
        FileStorage $storage
    ): self {
        $coinEloquent = CoinEloquent::find($coinId);
        $parameters = new CoinParameters($lang);

        return new self(
            CoinShort::getCollection($filter, $ordering, $lang, $storage),
            Coin::getByEloquent($coinEloquent, CoinPreset::old(), $parameters, $storage),
            Seo::getByCoinEloquent($coinEloquent, $lang),
            Article::getByCoinEloquent($coinEloquent, $lang),
            new FiltersForm(
                $parameters,
                $filter
            ),
            new OrderingForm(
                Ordering::getPairCollection($lang),
                $ordering
            )
        );
    }
}
