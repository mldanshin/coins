<?php

namespace Tests\Feature\Models\CRUD\Reader;

use App\Models\Article;
use App\Models\Seo;
use App\Models\LanguageType;
use App\Models\CRUD\CoinShort;
use App\Models\CRUD\Reader\Coin;
use App\Models\CRUD\Reader\PageShow;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;
use Tests\DataProvider\Ordering as OrderingDataProvider;
use Tests\DataProvider\Storage as StorageDataProvider;

class PageShowTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;
    use OrderingDataProvider;
    use StorageDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerCreate
     */
    public function testCreate(
        int $coinId,
        LanguageType $lang
    ): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $obj = PageShow::create(
            $this->getRequestFilterCRUDEmpty(),
            $this->getQueryOrderingEmpty(),
            $coinId,
            $lang,
            new FileStorage($disk)
        );

        $coinEloquent = CoinEloquent::find($coinId);
        $storage = new FileStorage($disk);
        $this->assertEquals(
            CoinShort::getCollection(
                $this->getRequestFilterCRUDEmpty(),
                $this->getQueryOrderingEmpty(),
                $lang,
                $storage
            ),
            $obj->coins
        );
        $this->assertEquals(Coin::getByEloquent($coinEloquent, $lang, $storage), $obj->coin);
        $this->assertEquals(Seo::getByCoinEloquent($coinEloquent, $lang), $obj->seo);
        $this->assertEquals(Article::getByCoinEloquent($coinEloquent, $lang), $obj->article);
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            [
                1,
                LanguageType::ru
            ],
            [
                3,
                LanguageType::en
            ],
        ];
    }
}
