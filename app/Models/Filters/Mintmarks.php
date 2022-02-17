<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

final class Mintmarks implements Filterable
{
    /**
     * @param int[] $value
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return (empty($value))
            ? $builder
            : $builder->whereHas(
                "mintmarkPivot",
                fn(Builder $query) => $query->whereIn("coin_mintmark.mintmark_id", $value)
            );
    }
}
