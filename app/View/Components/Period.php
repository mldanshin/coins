<?php

namespace App\View\Components;

use App\Models\Filters\Request\Period as PeriodModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Period extends Component
{
    public readonly ?string $first;
    public readonly ?string $last;

    public function __construct(
        PeriodModel $model,
        public readonly string $classSection,
        public readonly string $classTitle,
        public readonly string $classResettable,
    ) {
        $this->first = $model->first;
        $this->last = $model->last;
    }

    public function render(): View|\Closure|string
    {
        return view('components.period');
    }
}
