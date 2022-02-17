<?php

namespace App\Models;

use App\Models\ItemCollection;
use Illuminate\Support\Collection;

final class Languages
{
    /**
     * @param Collection<ItemCollection> $items
     */
    public function __construct(
        public readonly Collection $items,
        public readonly ItemCollection $current
    ) {
    }
}
