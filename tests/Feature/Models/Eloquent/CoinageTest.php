<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\Eloquent\Coinage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoinageTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, string $expected): void
    {
        $this->seed();

        $actual = Coinage::find($id)->translate($lang);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [1, LanguageType::ru, "Регулярный выпуск"],
            [1, LanguageType::en, "Regular"],
        ];
    }

    /**
     * @dataProvider providerGetPairCollection
     */
    public function testGetPairCollection(LanguageType $lang, ItemCollection $expected): void
    {
        $this->seed();

        $actual = Coinage::getPairCollection($lang);
        $this->assertTrue($actual->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetPairCollection(): array
    {
        return [
            [LanguageType::ru, new ItemCollection(2, "Юбилейные монеты")],
            [LanguageType::en, new ItemCollection(3, "Collectible")],
        ];
    }
}
