<?php

namespace Tests\Feature\Models\CRUD\Reader;

use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\CRUD\Reader\Coin;
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
        $this->seedStorage($disk);

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
                    "Москва",
                    "2013",
                    "Удовлетворительное",
                    "Папка №10",
                    new Picture(
                        1,
                        "picture coin",
                        "storage/image/1/obverse.ico",
                        "storage/image/1/reverse.ico",
                        "storage/image/default.svg"
                    ),
                    true,
                    true
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
                    null,
                    "2005",
                    "Удовлетворительное",
                    "Папка №550",
                    new Picture(
                        5,
                        "picture coin",
                        null,
                        null,
                        "storage/image/default.svg"
                    ),
                    true,
                    false
                )
            ],
            [
                6,
                fn() => new Coin(
                    6,
                    new CoinTitle(0.5, 2, "1979", LanguageType::ru),
                    "СССР",
                    "0.5",
                    "Коллекционные монеты",
                    "Бронза",
                    "Копейка",
                    "Четырёхугольник",
                    "География",
                    null,
                    "1979",
                    "Отличное",
                    "Шкаф №50",
                    new Picture(
                        6,
                        "picture coin",
                        "storage/image/6/obverse.svg",
                        null,
                        "storage/image/default.svg"
                    ),
                    false,
                    true
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
        $this->seedStorage($disk);

        config(["app.admin.paginate" => $valuePaginator]);

        $paginator = Coin::getCollection(
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
