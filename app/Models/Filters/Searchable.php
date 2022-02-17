<?php

namespace App\Models\Filters;

use App\Models\Filters\RequestBase;
use Illuminate\Database\Eloquent\Builder;

interface Searchable
{
    public function apply(RequestBase $request): Builder;
}
