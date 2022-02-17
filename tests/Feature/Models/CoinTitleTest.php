<?php

namespace Tests\Feature\Models;

use App\Models\CoinTitle;
use App\Models\LanguageType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CoinTitleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider providerCreate
     */
    public function testCreate(
        float $nominal,
        int $currencyId,
        string $year,
        LanguageType $lang,
        string $currencyExpected
    ): void {
        $this->seed();

        $title = new CoinTitle(
            $nominal,
            $currencyId,
            $year,
            $lang
        );

        $this->assertEquals($nominal, $title->nominal);
        $this->assertEquals($currencyExpected, $title->currency);
        $this->assertEquals($year, $title->year);
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            [7.5, 1, "2003", LanguageType::ru, "рубля"],
            [1, 1, "2010", LanguageType::en, "ruble"],
            [7.5, 1, "1990", LanguageType::en, "rubles"],
            [1, 1, "1993", LanguageType::ru, "рубль"],
            [15, 1, "1890", LanguageType::ru, "рублей"],
            [21, 1, "2010", LanguageType::ru, "рубль"],
            [11, 1, "2020", LanguageType::ru, "рублей"],
            [52, 1, "1989", LanguageType::ru, "рубля"],
            [55, 1, "2001", LanguageType::ru, "рублей"],
        ];
    }
}
