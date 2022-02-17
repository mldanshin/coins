<?php

namespace Tests\Feature\Models\CRUD\Saving;

use App\Models\Article;
use App\Models\LanguageType;
use App\Models\Seo;
use App\Models\CRUD\Saving\Coin;
use App\Models\CRUD\Saving\Page;
use App\Models\CRUD\Saving\Picture;
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
     * @dataProvider providerStore
     */
    public function testStore(Page $page): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $coinId = Page::store($page, LanguageType::ru, new FileStorage($disk));
        $this->assertTrue(ArticleEloquent::where("coin_id", $coinId)->exists());
        $this->assertTrue(CoinEloquent::where("id", $coinId)->exists());
        $this->assertTrue(SeoEloquent::where("coin_id", $coinId)->exists());
        $this->assertDirectoryExists($disk->path("image/$coinId"));
    }

    /**
     * @return mixed[]
     */
    public function providerStore(): array
    {
        return [
            [
                new Page(
                    new Coin(1, 10, 2, 3, 1, 1, 1, 1, "2013", 2, 1),
                    new Picture(null, null),
                    new Seo(0, "Это статья про монеты", "Монеты являются денежными средствами", "Монеты, статья про монеты"),
                    new Article(0, "Это статья про монеты", "Монеты являются денежными средствами")
                )
            ],
        ];
    }
}
