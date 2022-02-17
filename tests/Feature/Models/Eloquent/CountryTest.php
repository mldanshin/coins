<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\Eloquent\Country;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, string $expected): void
    {
        $this->seed();

        $actual = Country::find($id)->translate($lang);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [1, LanguageType::ru, "Россия"],
            [4, LanguageType::ru, "Украина"],
            [1, LanguageType::en, "Russia"],
            [3, LanguageType::en, "Kazakhstan"],
        ];
    }

    /**
     * @dataProvider providerGetPairCollection
     */
    public function testGetPairCollection(LanguageType $lang, ItemCollection $expected): void
    {
        $this->seed();

        $actual = Country::getPairCollection($lang);
        $this->assertTrue($actual->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetPairCollection(): array
    {
        return [
            [LanguageType::ru, new ItemCollection(2, "СССР")],
            [LanguageType::en, new ItemCollection(3, "Kazakhstan")],
        ];
    }
}
