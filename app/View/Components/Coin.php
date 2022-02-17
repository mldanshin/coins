<?php

namespace App\View\Components;

use App\Models\Coin as CoinModel;
use App\Models\CoinTitle;
use App\Models\Picture\Picture;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Coin extends Component
{
    public function __construct(
        public readonly CoinModel $model
    ) {
    }

    public function render(): View|\Closure|string
    {
        return view('components.coin');
    }
}
