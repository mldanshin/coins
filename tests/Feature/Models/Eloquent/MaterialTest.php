<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\Eloquent\Material;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, string $expected): void
    {
        $this->seed();

        $actual = Material::find($id)->translate($lang);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [1, LanguageType::ru, "Алюминиевая бронза"],
            [1, LanguageType::en, "Aluminum bronze"],
        ];
    }

    /**
     * @dataProvider providerGetPairCollection
     */
    public function testGetPairCollection(LanguageType $lang, ItemCollection $expected): void
    {
        $this->seed();

        $actual = Material::getPairCollection($lang);
        $this->assertTrue($actual->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetPairCollection(): array
    {
        return [
            [LanguageType::ru, new ItemCollection(1, "Алюминиевая бронза")],
            [LanguageType::en, new ItemCollection(10, "Palladium")],
        ];
    }
}
