<?php

namespace App\View\Components;

use App\Models\Languages;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

final class LanguageToogle extends Component
{
    public function __construct(
        public readonly Languages $languages,
        public readonly string $query
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.language-toogle');
    }
}
