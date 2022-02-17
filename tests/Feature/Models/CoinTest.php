<?php

namespace Tests\Feature\Models;

use App\Models\Coin;
use App\Models\CoinTitle;
use App\Models\LanguageType;
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

class CoinTest extends TestCase
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

        $obj = Coin::getByEloquent(
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
                fn() => new Coin(
                    1,
                    new CoinTitle(7.5, 1, "2013", LanguageType::ru),
                    "Россия",
                    "7.5",
                    "Юбилейные монеты",
                    "Бронза",
                    "Рубль",
                    "Четырёхугольник",
                    "Отсутствует",
                    "2013",
                    new Picture(
                        1,
                        "Монета 7.5 Рубль 2013, Россия",
                        "storage/image/1/obverse.ico",
                        "storage/image/1/reverse.ico",
                        "storage/image/default.svg"
                    )
                )
            ],
            [
                5,
                fn() => new Coin(
                    5,
                    new CoinTitle(1, 4, "2005", LanguageType::ru),
                    "Украина",
                    "1",
                    "Регулярный выпуск",
                    "Латунь",
                    "Гривна",
                    "Нестандарт",
                    "География",
                    "2005",
                    new Picture(
                        5,
                        "Монета 1 Гривна 2005, Украина",
                        null,
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

        config(["app.front.paginate" => $valuePaginator]);

        $disk = StorageFacade::fake("public");
        $this->seedStorage();

        $paginator = Coin::getCollection(
            $this->getRequestFilterEmpty(),
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
