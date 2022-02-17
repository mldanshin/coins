<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\Coin;
use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\Seo;
use App\Models\PageShow;
use App\Models\Picture\Picture;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class PageShowTest extends TestCase
{
    use DatabaseMigrations;
    use StorageDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerCreate
     */
    public function testCreate(
        int $coinId,
        callable $callbackSeoExpected,
        callable $callbackCoinExpected,
        ?Article $articleExpected
    ): void {
        $this->seed();

        config(["app.locale" => "ru"]);

        $disk = StorageFacade::fake("public");
        $this->seedStorage();

        $obj = PageShow::create($coinId, LanguageType::ru, new FileStorage($disk));

        $this->assertEquals($callbackSeoExpected(), $obj->seo);
        $this->assertEquals($callbackCoinExpected(), $obj->coin);
        $this->assertEquals($articleExpected, $obj->article);
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            [
                1,
                fn() => new Seo(
                    1,
                    "Рубль России",
                    "Рубль России выпускается Банком России",
                    "Валюта России"
                ),
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
                    ),
                ),
                new Article(
                    1,
                    "Статья про рубль России",
                    "В этой статья поговорим о валюте России..."
                )
            ],
            [
                3,
                fn() => Seo::getDefault(),
                fn() => new Coin(
                    3,
                    new CoinTitle(0.5, 3, "1998", LanguageType::ru),
                    "Казахстан",
                    "0.5",
                    "Юбилейные монеты",
                    "Алюминиевая бронза",
                    "Тенге",
                    "Четырёхугольник",
                    "География",
                    "1998",
                    new Picture(
                        3,
                        "Монета 0.5 Тенге 1998, Казахстан",
                        null,
                        null,
                        "storage/image/default.svg"
                    )
                ),
                null
            ],
        ];
    }
}
