<?php

namespace App\View\Components\Admin\Creator;

use App\Models\CRUD\Creator\Coin as CoinModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Coin extends Component
{
    public function __construct(
        public readonly CoinModel $coin,
        public readonly string $query
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.creator-editor.coin');
    }
}
