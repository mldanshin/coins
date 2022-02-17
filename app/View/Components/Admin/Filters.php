<?php

namespace App\View\Components\Admin;

use App\Models\CoinParameters;
use App\Models\CRUD\Filters\Form;
use App\Models\CRUD\Filters\Request\Coin;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Filters extends Component
{
    public readonly CoinParameters $parameters;
    public readonly Coin $values;

    public function __construct(Form $model)
    {
        $this->parameters = $model->parameters;
        $this->values = $model->values;
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.filters');
    }
}
