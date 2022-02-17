<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\Eloquent\Ordering;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderingTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, string $expected): void
    {
        $this->seed();

        $actual = Ordering::find($id)->translate($lang);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [2, LanguageType::en, "currency and nominal"],
            [1, LanguageType::ru, "году"],
        ];
    }

    /**
     * @dataProvider providerGetPairCollection
     */
    public function testGetPairCollection(LanguageType $lang, ItemCollection $expected): void
    {
        $this->seed();

        $actual = Ordering::getPairCollection($lang);
        $this->assertTrue($actual->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetPairCollection(): array
    {
        return [
            [LanguageType::ru, new ItemCollection(2, "валюте и номиналу")],
            [LanguageType::en, new ItemCollection(1, "year")],
        ];
    }
}
