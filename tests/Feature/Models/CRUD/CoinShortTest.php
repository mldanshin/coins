<?php

namespace Tests\Feature\Models\CRUD;

use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\CRUD\CoinShort;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Picture\Picture;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;
use Tests\DataProvider\Ordering as OrderingDataProvider;
use Tests\DataProvider\Storage as StorageDataProvider;

class CoinShortTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;
    use OrderingDataProvider;
    use StorageDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetByEloquent
     */
    public function testGetByEloquent(int $coinId, callable $callbackExpected): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage();

        $obj = CoinShort::getByEloquent(
            CoinEloquent::find($coinId),
            LanguageType::ru,
            new FileStorage($disk)
        );
        $this->assertEquals($callbackExpected(), $obj);
    }

    /**
     * @return mixed[]
     */
    public function providerGetByEloquent(): array
    {
        return [
            [
                1,
                fn() => new CoinShort(
                    1,
                    new CoinTitle(7.5, 1, "2013", LanguageType::ru),
                    new Picture(
                        1,
                        "picture coin",
                        "storage/image/1/obverse.ico",
                        "storage/image/1/reverse.ico",
                        "storage/image/default.svg"
                    )
                )
            ],
            [
                5,
                fn() => new CoinShort(
                    5,
                    new CoinTitle(1, 4, "2005", LanguageType::ru),
                    new Picture(
                        5,
                        "picture coin",
                        null,
                        null,
                        "storage/image/default.svg"
                    )
                )
            ],
            [
                6,
                fn() => new CoinShort(
                    6,
                    new CoinTitle(0.5, 2, "1979", LanguageType::ru),
                    new Picture(
                        6,
                        "picture coin",
                        "storage/image/6/obverse.svg",
                        null,
                        "storage/image/default.svg"
                    )
                )
            ],
        ];
    }

    /**
     * @dataProvider providerGetCollection
     */
    public function testGetCollection(int $valuePaginator, int $expectedCount): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage();

        config(["app.admin.paginate" => $valuePaginator]);

        $paginator = CoinShort::getCollection(
            $this->getRequestFilterCRUDEmpty(),
            $this->getQueryOrderingEmpty(),
            LanguageType::ru,
            new FileStorage($disk)
        );

        $this->assertEquals($expectedCount, $paginator->count());
    }

    /**
     * @return mixed[]
     */
    public function providerGetCollection(): array
    {
        return [
            [1, 1],
            [3, 3],
            [10, 10]
        ];
    }
}
