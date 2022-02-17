<?php

namespace App\Models\CRUD\Filters\Request;

use App\Models\Filters\RequestBase;
use App\Models\Filters\Request\Period;
use App\Models\Filters\Request\Search;

final class Coin implements RequestBase
{
    /**
     * @param int[] $countries
     * @param int[] $nominals
     * @param int[] $coinages
     * @param int[] $materials
     * @param int[] $currencies
     * @param int[] $shapes
     * @param int[] $themes
     * @param int[] $mintmarks
     * @param int[] $qualities
     * @param int[] $storages
     */
    public function __construct(
        public readonly Search $search,
        public readonly Period $period,
        public readonly array $countries,
        public readonly array $nominals,
        public readonly array $coinages,
        public readonly array $materials,
        public readonly array $currencies,
        public readonly array $shapes,
        public readonly array $themes,
        public readonly array $mintmarks,
        public readonly array $qualities,
        public readonly array $storages,
    ) {
    }

    /**
     * @return mixed[]
     */
    public function getPairs(): array
    {
        return get_object_vars($this);
    }
}
