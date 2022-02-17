<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\LanguageType;
use App\Models\Eloquent\Language;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetIdByType
     */
    public function testGetIdByType(LanguageType $langType, int $expected): void
    {
        $this->seed();

        $actual = Language::getIdByType($langType);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerGetIdByType(): array
    {
        return [
            [LanguageType::ru, 2],
            [LanguageType::en, 1],
        ];
    }

    /**
     * @dataProvider providerGetByType
     */
    public function testGetByType(LanguageType $langType, int $expected): void
    {
        $this->seed();

        $actual = Language::getByType($langType);
        $this->assertEquals(Language::find($expected), $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerGetByType(): array
    {
        return [
            [LanguageType::ru, 2],
            [LanguageType::en, 1],
        ];
    }
}
