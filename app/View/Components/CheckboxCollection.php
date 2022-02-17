<?php

namespace App\View\Components;

use App\Models\ItemCollection;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

final class CheckboxCollection extends Component
{
    /**
     * @param Collection<ItemCollection> $items
     * @param array<int> $selectedItems
     */
    public function __construct(
        public readonly Collection $items,
        public readonly array $selectedItems,
        public readonly string $title,
        public readonly string $prefixId,
        public readonly string $name,
        public readonly string $classSection,
        public readonly string $classTitle,
        public readonly string $classResettable
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.checkbox-collection');
    }
}
