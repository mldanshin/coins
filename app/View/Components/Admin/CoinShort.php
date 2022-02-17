<?php

namespace App\View\Components\Admin;

use App\Models\CRUD\CoinShort as CoinShortModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class CoinShort extends Component
{
    public function __construct(
        public readonly CoinShortModel $model
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.coin-short');
    }
}
