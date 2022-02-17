<?php

namespace App\Models\CRUD\Reader;

use App\Models\Article;
use App\Models\CoinParameters;
use App\Models\LanguageType;
use App\Models\PageBase;
use App\Models\Seo;
use App\Models\Eloquent\Ordering;
use App\Models\CRUD\CoinShort;
use App\Models\CRUD\Filters\Form as FiltersForm;
use App\Models\CRUD\Filters\Request\Coin as FilterRequest;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Ordering\Form as OrderingForm;
use App\Models\Ordering\Request as OrderingRequest;
use App\Services\FileStorage;
use Illuminate\Pagination\LengthAwarePaginator;

final class PageShow extends PageBase
{
    /**
     * @param LengthAwarePaginator<CoinShort> $coins
     */
    public function __construct(
        LanguageType $languageType,
        public readonly LengthAwarePaginator $coins,
        public readonly ?Seo $seo,
        public readonly Coin $coin,
        public readonly ?Article $article,
        public readonly FiltersForm $filtersForm,
        public readonly OrderingForm $orderingForm
    ) {
        parent::__construct($languageType);
    }

    public static function create(
        FilterRequest $filter,
        OrderingRequest $ordering,
        int $coinId,
        LanguageType $lang,
        FileStorage $storage
    ): self {
        $coinEloquent = CoinEloquent::find($coinId);

        return new self(
            $lang,
            CoinShort::getCollection($filter, $ordering, $lang, $storage),
            Seo::getByCoinEloquent($coinEloquent, $lang),
            Coin::getByEloquent($coinEloquent, $lang, $storage),
            Article::getByCoinEloquent($coinEloquent, $lang),
            new FiltersForm(
                new CoinParameters($lang),
                $filter
            ),
            new OrderingForm(
                Ordering::getPairCollection($lang),
                $ordering
            )
        );
    }
}
