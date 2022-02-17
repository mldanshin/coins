<?php

namespace App\View\Components;

use App\Models\ItemCollection;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

final class Selection extends Component
{
    /**
     * @param Collection<ItemCollection> $items
     */
    public function __construct(
        public readonly bool $required,
        public readonly Collection $items,
        public readonly null|int|string $selectedItem,
        public readonly string $id = "",
        public readonly ?string $class = null,
        public readonly string $name = "",
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.selection');
    }
}
