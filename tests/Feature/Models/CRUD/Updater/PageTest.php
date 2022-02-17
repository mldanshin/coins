<?php

namespace Tests\Feature\Models\CRUD\Updater;

use App\Models\Article;
use App\Models\LanguageType;
use App\Models\Seo;
use App\Models\CRUD\Updater\Coin;
use App\Models\CRUD\Updater\Page;
use App\Models\CRUD\Updater\Picture;
use App\Models\Eloquent\Article as ArticleEloquent;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\Seo as SeoEloquent;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class PageTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use StorageDataProvider;

    /**
     * @dataProvider providerUpdate
     */
    public function testUpdate(Page $page): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $coinId = Page::update($page, LanguageType::ru, new FileStorage($disk));
        $this->assertTrue(ArticleEloquent::where("coin_id", $coinId)->exists());
        $this->assertTrue(CoinEloquent::where("id", $coinId)->exists());
        $this->assertTrue(SeoEloquent::where("coin_id", $coinId)->exists());
        $this->assertDirectoryExists($disk->path("image/$coinId"));
    }

    /**
     * @return mixed[]
     */
    public function providerUpdate(): array
    {
        return [
            [
                new Page(
                    new Coin(1, 2, 1, 1, 2, 2, 2, 2, 2, "2014", 1, 2),
                    new Picture(1, null, null),
                    new Seo(0, "Это статья про монеты", "Монеты являются денежными средствами", "Монеты, статья про монеты"),
                    new Article(1, "Это статья про монеты", "Монеты являются денежными средствами"),
                )
            ],
        ];
    }

    /**
     * @dataProvider providerDelete
     */
    public function testDelete(int $coinId): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        Page::delete($coinId, new FileStorage($disk));

        $this->assertFalse(CoinEloquent::where("id", $coinId)->exists());
        $this->assertDirectoryDoesNotExist($disk->path("image/$coinId"));
    }

    /**
     * @return mixed[]
     */
    public function providerDelete(): array
    {
        return [
            [1],
            [5],
            [6]
        ];
    }
}
