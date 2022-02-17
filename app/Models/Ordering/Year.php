<?php

namespace App\Models\Ordering;

use App\Models\LanguageType;
use Illuminate\Database\Eloquent\Builder;

final class Year implements Orderable
{
    public function apply(Builder $builder, LanguageType $lang): Builder
    {
        return $builder->orderBy("coins.year");
    }
}
