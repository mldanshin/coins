<?php

namespace Tests\Feature\Resources\Views\Partials;

use App\Models\Coin;
use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\Picture\Picture;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

final class CoinTableTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider providerSuccess
     */
    public function testSuccess(callable $callbackCoin): void
    {
        $this->seed();
        $coin = $callbackCoin();

        $view = $this->view("partials.coin-table", ["coin" => $coin]);

        $view->assertSee($coin->country);
        $view->assertSee($coin->nominal);
        $view->assertSee($coin->coinage);
        $view->assertSee($coin->material);
        $view->assertSee($coin->currency);
        $view->assertSee($coin->shape);
        $view->assertSee($coin->theme);
        $view->assertSee($coin->year);
    }

    /**
     * @return array<mixed>
     */
    public function providerSuccess(): array
    {
        return [
            [
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
            ]
        ];
    }
}
