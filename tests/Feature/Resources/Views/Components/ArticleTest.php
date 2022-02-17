<?php

namespace Tests\Feature\Resources\Views\Components;

use App\Models\Article as ArticleModel;
use Tests\TestCase;

final class ArticleTest extends TestCase
{
    /**
     * @dataProvider providerSuccess
     */
    public function testSuccess(ArticleModel $model): void
    {
        $view = $this->blade('<x-article :model="$model" />', ["model" => $model]);

        $view->assertSee($model->title);
        $view->assertSee($model->content);
    }

    /**
     * @return array<mixed>
     */
    public function providerSuccess(): array
    {
        return [
            [
                new ArticleModel(
                    1,
                    "Зто заголовок статьи",
                    "А это сама статья"
                )
            ]
        ];
    }
}
