<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

final class Countries implements Filterable
{
    /**
     * @param int[] $value
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return (empty($value)) ? $builder :  $builder->whereIn("coins.country_id", $value);
    }
}
