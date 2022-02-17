<?php

namespace App\Models\Ordering;

use App\Models\LanguageType;
use Illuminate\Database\Eloquent\Builder;

interface Orderable
{
    public function apply(Builder $builder, LanguageType $lang): Builder;
}
