<?php

namespace Tests\Feature\Models\CRUD\Editor;

use App\Models\LanguageType;
use App\Models\CRUD\CoinShort;
use App\Models\CRUD\Editor\Coin;
use App\Models\CRUD\Editor\Page;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;
use Tests\DataProvider\Ordering as OrderingDataProvider;

class PageTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;
    use OrderingDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerCreate
     */
    public function testCreate(
        int $coinId,
        LanguageType $lang,
        ?int $seoId,
        ?int $articleId,
    ): void {
        $this->seed();

        $obj = Page::create(
            $this->getRequestFilterCRUDEmpty(),
            $this->getQueryOrderingEmpty(),
            $coinId,
            $lang,
            FileStorage::instance()
        );

        $this->assertEquals($coinId, $obj->coin->id);
        $this->assertEquals(
            CoinShort::getCollection(
                $this->getRequestFilterCRUDEmpty(),
                $this->getQueryOrderingEmpty(),
                $lang,
                FileStorage::instance()
            ),
            $obj->coins
        );
        $this->assertInstanceOf(Coin::class, $obj->coin);
        $this->assertEquals($seoId, $obj->seo?->id);
        $this->assertEquals($articleId, $obj->article?->id);
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            [1, LanguageType::ru, 1, 1],
            [2, LanguageType::ru, null, 3],
            [5, LanguageType::ru, 2, null],
            [6, LanguageType::ru, null, 2],
            [2, LanguageType::en, null, null],
        ];
    }
}
