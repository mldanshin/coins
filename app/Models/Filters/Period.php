<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

final class Period implements Filterable
{
    /**
     * @param \App\Models\Filters\Request\Period $value
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        if ($value->first !== null) {
            $builder = $builder->where("coins.year", ">=", $value->first);
        }
        if ($value->last !== null) {
            $builder = $builder->where("coins.year", "<=", $value->last);
        }

        return $builder;
    }
}
