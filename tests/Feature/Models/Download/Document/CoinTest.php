<?php

namespace Tests\Feature\Models\Download\Document;

use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\Download\Document\Coin;
use App\Models\Download\Document\Picture\Picture;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Lang as LangDataProvider;
use Tests\DataProvider\Storage as StorageDataProvider;

class CoinTest extends TestCase
{
    use DatabaseMigrations;
    use LangDataProvider;
    use StorageDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetById
     */
    public function testGetById(int $coinId, callable $callbackExpected): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $obj = Coin::getById(
            $coinId,
            LanguageType::ru,
            new FileStorage($disk)
        );
        $this->assertEquals($callbackExpected($disk), $obj);
    }

    /**
     * @return mixed[]
     */
    public function providerGetById(): array
    {
        return [
            [
                1,
                fn($disk) => new Coin(
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
                        $disk->path("image/1/obverse.ico"),
                        $disk->path("image/1/reverse.ico"),
                    )
                )
            ],
            [
                5,
                fn($disk) => new Coin(
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
                        null,
                        null,
                    )
                )
            ],
            [
                6,
                fn($disk) => new Coin(
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
                        $disk->path("image/6/obverse.svg"),
                        null
                    )
                )
            ],
        ];
    }

    public function testGetCollection(): void
    {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $collection = Coin::getCollection(LanguageType::ru, new FileStorage($disk));

        $this->assertCount(11, $collection);
    }
}
