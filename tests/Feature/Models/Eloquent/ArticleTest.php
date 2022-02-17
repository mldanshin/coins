<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\LanguageType;
use App\Models\Eloquent\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, ?string $expected): void
    {
        $this->seed();

        $actual = Article::find($id)->translate($lang)?->title;
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [1, LanguageType::ru, "Статья про рубль России"],
            [1, LanguageType::en, "Article about the Russian Ruble"],
            [3, LanguageType::en, null],
        ];
    }
}
