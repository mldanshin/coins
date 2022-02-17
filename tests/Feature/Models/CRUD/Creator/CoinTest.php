<?php

namespace Tests\Feature\Models\CRUD\Creator;

use App\Models\CoinParameters;
use App\Models\LanguageType;
use App\Models\CRUD\CoinPreset;
use App\Models\CRUD\Creator\Coin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoinTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetByPreset
     */
    public function testGetByPreset(
        CoinPreset $preset,
        CoinPreset $old,
        CoinPreset $expected
    ): void {
        $this->seed();

        $coinParameters = new CoinParameters(LanguageType::ru);

        $obj = Coin::getByPreset($preset, $old, $coinParameters);

        $this->assertEquals($expected->country, $obj->country);
        $this->assertEquals($expected->nominal, $obj->nominal);
        $this->assertEquals($expected->coinage, $obj->coinage);
        $this->assertEquals($expected->material, $obj->material);
        $this->assertEquals($expected->currency, $obj->currency);
        $this->assertEquals($expected->shape, $obj->shape);
        $this->assertEquals($expected->theme, $obj->theme);
        $this->assertEquals($expected->mintmark, $obj->mintmark);
        $this->assertEquals($expected->year, $obj->year);
        $this->assertEquals($expected->quality, $obj->quality);
        $this->assertEquals($expected->storage, $obj->storage);
        $this->assertEquals($coinParameters, $obj->parameters);
    }

    /**
     * @return mixed[]
     */
    public function providerGetByPreset(): array
    {
        return [
            [
                new CoinPreset(
                    1,
                    null,
                    2,
                    3,
                    null,
                    2,
                    null,
                    null,
                    "2022",
                    2,
                    1
                ),
                new CoinPreset(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                new CoinPreset(
                    1,
                    null,
                    2,
                    3,
                    null,
                    2,
                    null,
                    null,
                    "2022",
                    2,
                    1
                ),
            ],
            [
                new CoinPreset(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                new CoinPreset(
                    1,
                    null,
                    2,
                    3,
                    null,
                    2,
                    null,
                    null,
                    "2022",
                    2,
                    1
                ),
                new CoinPreset(
                    1,
                    null,
                    2,
                    3,
                    null,
                    2,
                    null,
                    null,
                    "2022",
                    2,
                    1
                ),
            ],
            [
                new CoinPreset(
                    2,
                    3,
                    null,
                    1,
                    null,
                    null,
                    null,
                    null,
                    "2021",
                    null,
                    5
                ),
                new CoinPreset(
                    1,
                    null,
                    2,
                    3,
                    null,
                    2,
                    null,
                    null,
                    null,
                    2,
                    1
                ),
                new CoinPreset(
                    1,
                    3,
                    2,
                    3,
                    null,
                    2,
                    null,
                    null,
                    "2021",
                    2,
                    1
                ),
            ],
        ];
    }
}
