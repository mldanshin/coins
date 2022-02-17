<?php

namespace App\View\Components;

use App\Models\ItemCollection;
use App\Models\Ordering\Form;
use App\Models\Ordering\Request;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

final class Ordering extends Component
{
    /**
     * @property Collection<ItemCollection> $parameters
     */
    public readonly Collection $parameters;
    public readonly Request $values;

    public function __construct(Form $model)
    {
        $this->parameters = $model->parameters;
        $this->values = $model->value;
    }

    public function render(): View|\Closure|string
    {
        return view('components.ordering');
    }
}
