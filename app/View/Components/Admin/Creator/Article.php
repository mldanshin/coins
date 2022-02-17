<?php

namespace App\View\Components\Admin\Creator;

use App\Models\Article as ArticleModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class Article extends Component
{
    public readonly string $title;
    public readonly string $content;

    public function __construct(ArticleModel $model)
    {
        $this->title = old("article-title") ?? $model->title;
        $this->content = old("article-content") ?? $model->content;
    }

    public function render(): View|\Closure|string
    {
        return view('components.admin.creator-editor.article');
    }
}
