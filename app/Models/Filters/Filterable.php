<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filterable
{
    public function apply(Builder $builder, mixed $value): Builder;
}
