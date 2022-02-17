<?php

namespace App\View\Components;

use App\Models\CoinTitle as CoinTitleModel;
use App\Models\Picture\Picture;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class CoinTitle extends Component
{
    public readonly string $nominal;
    public readonly string $currency;
    public readonly string $year;
    public readonly string $nameCoin;

    public function __construct(CoinTitleModel $model)
    {
        $this->nominal = (string)$model->nominal;
        $this->currency = $model->currency;
        $this->year = $model->year;
        $this->nameCoin = __("coin.name");
    }

    public function render(): View|\Closure|string
    {
        return view('components.coin-title');
    }
}
