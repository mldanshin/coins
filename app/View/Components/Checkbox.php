<?php

namespace App\View\Components;

use App\Models\ItemCollection;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Checkbox extends Component
{
    public readonly string $id;
    public readonly string $label;
    public readonly string $value;

    public function __construct(
        ItemCollection $item,
        string $id,
        public readonly string $class,
        public readonly string $name,
        public readonly bool $isSelected,
    ) {
        $this->id = "$id-$item->id";
        $this->label = $item->name;
        $this->value = (string)$item->id;
    }

    public function render(): View|\Closure|string
    {
        return view('components.checkbox');
    }
}
