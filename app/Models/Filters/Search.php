<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

final class Search implements Filterable
{
    /**
     * @param \App\Models\Filters\Request\Search $value
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder;
    }
}
