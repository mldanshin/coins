<?php

namespace App\View\Components;

use App\Models\Picture\Picture as Model;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

final class Picture extends Component
{
    public readonly string $obverse;
    public readonly string $obverseDescription;
    public readonly string $reverse;
    public readonly string $reverseDescription;

    public function __construct(
        public readonly string $class,
        Model $model,
        public readonly int $width
    ) {
        $this->obverse = $model->obverse ?? $model->default;
        $this->reverse = $model->reverse ?? $model->default;
        $this->obverseDescription =
            ($model->obverse === null)
                ? "picture coin obverse"
                : $model->description . ", " . __("coin.picture.obverse");
        $this->reverseDescription =
            ($model->reverse === null)
                ? "picture coin reverse"
                : $model->description . ", " . __("coin.picture.reverse");
    }

    public function render(): View|\Closure|string
    {
        return view('components.picture');
    }
}
