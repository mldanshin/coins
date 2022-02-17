<?php

namespace App\Models\Ordering;

use App\Models\LanguageType;
use App\Models\Ordering\Request;
use Illuminate\Database\Eloquent\Builder;

final class CoinOrdering
{
    public function __construct(
        private readonly Builder $builder
    ) {
    }

    public function apply(Request $request, LanguageType $lang): Builder
    {
        $class = $this->createClassName($request->value);
        return (new $class())->apply($this->builder, $lang);
    }

    private function createClassName(int $value): string
    {
        $array = [
            1 => __NAMESPACE__ . "\Year",
            2 => __NAMESPACE__ . "\CurrencyAndNominal",
        ];

        return $array[$value];
    }
}
