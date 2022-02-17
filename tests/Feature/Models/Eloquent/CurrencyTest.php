<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\Eloquent\Currency;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, string $expected): void
    {
        $this->seed();

        $actual = Currency::find($id)->translate($lang);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [1, LanguageType::ru, "Рубль"],
            [1, LanguageType::en, "Ruble"],
        ];
    }

    /**
     * @dataProvider providerGetPairCollection
     */
    public function testGetPairCollection(LanguageType $lang, ItemCollection $expected): void
    {
        $this->seed();

        $actual = Currency::getPairCollection($lang);
        $this->assertTrue($actual->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetPairCollection(): array
    {
        return [
            [LanguageType::ru, new ItemCollection(2, "Копейка")],
            [LanguageType::en, new ItemCollection(4, "Hryvnia")],
        ];
    }

    /**
     * @dataProvider providerGetMapTranslation
     */
    public function testGetMapTranslation(LanguageType|string $lang, string $expected): void
    {
        $this->seed();

        $actual = (new Currency())->getMapTranslation($lang);
        $this->assertTrue(str_contains($actual["class"], $expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetMapTranslation(): array
    {
        return [
            [LanguageType::ru, "CurrencyRu"],
            ["en", "CurrencyEn"],
        ];
    }
}
