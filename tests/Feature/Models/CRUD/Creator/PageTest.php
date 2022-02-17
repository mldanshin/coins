<?php

namespace Tests\Feature\Models\CRUD\Creator;

use App\Models\Article;
use App\Models\LanguageType;
use App\Models\Seo;
use App\Models\CRUD\CoinShort;
use App\Models\CRUD\Creator\Coin;
use App\Models\CRUD\Creator\Page;
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

    public function testCreate(): void
    {
        $this->seed();

        $obj = Page::create(
            $this->getRequestFilterCRUDEmpty(),
            $this->getQueryOrderingEmpty(),
            LanguageType::ru,
            FileStorage::instance()
        );

        $this->assertEquals(
            CoinShort::getCollection(
                $this->getRequestFilterCRUDEmpty(),
                $this->getQueryOrderingEmpty(),
                LanguageType::ru,
                FileStorage::instance()
            ),
            $obj->coins
        );
        $this->assertInstanceOf(Coin::class, $obj->coin);
        $this->assertInstanceOf(Article::class, $obj->article);
        $this->assertInstanceOf(Seo::class, $obj->seo);
    }
}
