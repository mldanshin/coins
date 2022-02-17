<?php

namespace App\View\Components\Admin\Reader;

use App\Models\CRUD\Reader\Coin as CoinModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Coin extends Component
{
    public function __construct(
        public readonly CoinModel $model,
        public readonly string $query
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.reader.coin');
    }
}
