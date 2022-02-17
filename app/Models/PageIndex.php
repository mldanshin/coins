<?php

namespace App\Models;

use App\Models\CoinParameters;
use App\Models\Eloquent\Ordering;
use App\Models\Filters\Form as FiltersForm;
use App\Models\Filters\Request\Coin as FilterRequest;
use App\Models\Ordering\Form as OrderingForm;
use App\Models\Ordering\Request as OrderingRequest;
use App\Services\FileStorage;
use Illuminate\Pagination\LengthAwarePaginator;

final class PageIndex extends PageBase
{
    /**
     * @param LengthAwarePaginator<Coin> $coins
     */
    public function __construct(
        LanguageType $languageType,
        public readonly LengthAwarePaginator $coins,
        public readonly Seo $seo,
        public readonly FiltersForm $filtersForm,
        public readonly OrderingForm $orderingForm
    ) {
        parent::__construct($languageType);
    }

    public static function create(
        FilterRequest $filter,
        OrderingRequest $ordering,
        LanguageType $lang,
        FileStorage $storage
    ): self {
        return new self(
            $lang,
            Coin::getCollection($filter, $ordering, $lang, $storage),
            Seo::getDefault(),
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
