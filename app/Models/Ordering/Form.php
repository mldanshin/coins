<?php

namespace App\Models\Ordering;

use App\Models\ItemCollection;
use App\Models\Ordering\Request as Value;
use Illuminate\Support\Collection;

final class Form
{
    /**
     * @param Collection<ItemCollection> $parameters
     */
    public function __construct(
        public readonly Collection $parameters,
        public readonly Value $value,
    ) {
    }
}
