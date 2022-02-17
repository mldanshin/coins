<?php

namespace App\Models\Filters\Request;

use App\Models\Filters\RequestBase;

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
