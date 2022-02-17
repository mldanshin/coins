<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\Eloquent\Theme;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThemeTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, string $expected): void
    {
        $this->seed();

        $actual = Theme::find($id)->translate($lang);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [2, LanguageType::ru, "География"],
            [2, LanguageType::en, "Geography"],
        ];
    }

    /**
     * @dataProvider providerGetPairCollection
     */
    public function testGetPairCollection(LanguageType $lang, ItemCollection $expected): void
    {
        $this->seed();

        $actual = Theme::getPairCollection($lang);
        $this->assertTrue($actual->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetPairCollection(): array
    {
        return [
            [LanguageType::ru, new ItemCollection(1, "Отсутствует")],
            [LanguageType::en, new ItemCollection(2, "Geography")],
        ];
    }
}
