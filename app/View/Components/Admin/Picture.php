<?php

namespace App\View\Components\Admin;

use App\Models\CRUD\Editor\Picture\Picture as Model;
use App\Models\CRUD\Editor\Picture\Source;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

final class Picture extends Component
{
    public readonly ?Source $obverse;
    public readonly ?Source $reverse;
    public readonly string $supportedExtensions;

    public function __construct(
        ?Model $model,
        public readonly int $width
    ) {
        $this->obverse = $model?->obverse;
        $this->reverse = $model?->reverse;
        $this->supportedExtensions = $this->getSupportedExtensions();
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.picture');
    }

    private function getSupportedExtensions(): string
    {
        $string = "";

        $array = config("app.picture_supported");
        $count = count($array);

        for ($i = 0; $i < $count; $i++) {
            $string .= ".$array[$i]";
            if (($i + 1) !== $count) {
                $string .= ", ";
            }
        }
        return $string;
    }
}
