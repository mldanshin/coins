<?php

namespace App\View\Components\Admin\Creator;

use App\Models\Seo as SeoModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Seo extends Component
{
    public readonly string $title;
    public readonly string $description;
    public readonly string $keywords;

    public function __construct(SeoModel $model)
    {
        $this->title = old("seo-title") ?? $model->title;
        $this->description = old("seo-description") ?? $model->description;
        $this->keywords = old("seo-keywords") ?? $model->keywords;
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.creator-editor.seo');
    }
}
