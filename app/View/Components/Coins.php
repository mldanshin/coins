<?php

namespace App\View\Components;

use App\Models\Coin as CoinModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Coins extends Component
{
    /**
     * @param LengthAwarePaginator<CoinModel> $paginator
     */
    public function __construct(
        public readonly LengthAwarePaginator $paginator,
        public readonly string $query
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.coins');
    }
}
