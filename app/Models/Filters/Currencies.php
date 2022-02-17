<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

final class Currencies implements Filterable
{
    /**
     * @param int[] $value
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return (empty($value)) ? $builder : $builder->whereIn("coins.currency_id", $value);
    }
}
