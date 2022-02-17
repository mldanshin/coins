<?php

namespace App\View\Components\Admin;

use App\Models\CRUD\CoinShort as CoinShortModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class CoinsShort extends Component
{
    /**
     * @param LengthAwarePaginator<CoinShortModel> $paginator
     */
    public function __construct(
        public readonly LengthAwarePaginator $paginator,
        public readonly string $queryExceptPaginator,
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.coins-short');
    }
}
