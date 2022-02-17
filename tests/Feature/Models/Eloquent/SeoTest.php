<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\LanguageType;
use App\Models\Eloquent\Seo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerTranslate
     */
    public function testTranslate(int $id, LanguageType $lang, string $expected): void
    {
        $this->seed();

        $actual = Seo::find($id)->translate($lang)->title;
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerTranslate(): array
    {
        return [
            [1, LanguageType::ru, "Рубль России"],
            [1, LanguageType::en, "Russian Ruble"],
        ];
    }
}
