<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\Eloquent\Article as ArticleEloquent;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\LanguageType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetByCoinEloquent
     */
    public function testGetByCoinEloquent(int $coinId, ?Article $article): void
    {
        $this->seed();

        $obj = Article::getByCoinEloquent(CoinEloquent::find($coinId), LanguageType::ru);
        $this->assertEquals($article, $obj);
    }

    /**
     * @return mixed[]
     */
    public function providerGetByCoinEloquent(): array
    {
        return [
            [
                1,
                new Article(
                    1,
                    "Статья про рубль России",
                    "В этой статья поговорим о валюте России..."
                )
            ],
            [
                3,
                null
            ],
        ];
    }

    public function testGetEmpty(): void
    {
        $obj = Article::getEmpty();
        $this->assertEquals("", $obj->title);
        $this->assertEquals("", $obj->content);
    }

    /**
     * @dataProvider providerStore
     */
    public function testStore(int $coinId, Article $article, LanguageType $lang): void
    {
        $this->seed();

        $id = Article::storeOrUpdate($coinId, $article, $lang);

        $articleEloquent = ArticleEloquent::find($id)->translate($lang);
        $this->assertEquals($article->title, $articleEloquent->title);
        $this->assertEquals($article->content, $articleEloquent->content);
    }

    /**
     * @return mixed[]
     */
    public function providerStore(): array
    {
        return [
            [
                2,
                new Article(0, "Это статья про монеты", "Монеты являются денежными средствами"),
                LanguageType::ru
            ],
        ];
    }

    /**
     * @dataProvider providerUpdate
     */
    public function testUpdate(int $coinId, Article $article, LanguageType $lang): void
    {
        $this->seed();

        $id = Article::storeOrUpdate($coinId, $article, $lang);

        $articleEloquent = ArticleEloquent::find($id)->translate($lang);
        $this->assertEquals($article->title, $articleEloquent->title);
        $this->assertEquals($article->content, $articleEloquent->content);

        $this->assertFalse($article->id === $articleEloquent->language_id);
        $this->assertFalse($articleEloquent->where("title", "Статья про рубль России")->exists());
    }

    /**
     * @return mixed[]
     */
    public function providerUpdate(): array
    {
        return [
            [
                1,
                new Article(1, "Это статья про монеты", "Монеты являются денежными средствами"),
                LanguageType::ru
            ],
        ];
    }

    /**
     * @dataProvider providerDelete
     */
    public function testDelete(int $coinId): void
    {
        $this->seed();

        Article::delete($coinId);

        $this->assertFalse(ArticleEloquent::where("coin_id", $coinId)->exists());
    }

    /**
     * @return mixed[]
     */
    public function providerDelete(): array
    {
        return [
            [1],
            [6]
        ];
    }
}
