<?php

namespace Tests\Feature\Models\CRUD;

use App\Models\CRUD\CoinPreset;
use Tests\TestCase;

class CoinPresetTest extends TestCase
{
    public function testGet(): void
    {
        session(["coin_preset_coinage" => 2]);
        session(["coin_preset_theme" => 1]);
        session(["coin_preset_year" => "2010"]);

        $coin = CoinPreset::get();
        $this->assertEquals(config("app.coin_preset.country"), $coin->country);
        $this->assertEquals(config("app.coin_preset.nominal"), $coin->nominal);
        $this->assertEquals(2, $coin->coinage);
        $this->assertEquals(config("app.coin_preset.material"), $coin->material);
        $this->assertEquals(config("app.coin_preset.currency"), $coin->currency);
        $this->assertEquals(config("app.coin_preset.shape"), $coin->shape);
        $this->assertEquals(1, $coin->theme);
        $this->assertEquals("2010", $coin->year);
        $this->assertEquals(config("app.coin_preset.quality"), $coin->quality);
        $this->assertEquals(config("app.coin_preset.storage"), $coin->storage);
    }

    /**
     * @dataProvider providerSave
     */
    public function testSave(CoinPreset $coinExpected): void
    {
        CoinPreset::save($coinExpected);

        $coinActual = CoinPreset::get();

        $this->assertEquals($coinExpected->country, $coinActual->country);
        $this->assertEquals($coinExpected->nominal, $coinActual->nominal);
        $this->assertEquals($coinExpected->coinage, $coinActual->coinage);
        $this->assertEquals($coinExpected->material, $coinActual->material);
        $this->assertEquals($coinExpected->currency, $coinActual->currency);
        $this->assertEquals($coinExpected->shape, $coinActual->shape);
        $this->assertEquals($coinExpected->theme, $coinActual->theme);
        $this->assertEquals($coinExpected->year, $coinActual->year);
        $this->assertEquals($coinExpected->quality, $coinActual->quality);
        $this->assertEquals($coinExpected->storage, $coinActual->storage);
    }

    /**
     * @return mixed[]
     */
    public function providerSave(): array
    {
        return [
            [
                new CoinPreset(2, 1, 1, 2, 2, 2, 2, 2, "2014", 1, 2)
            ],
        ];
    }

    /**
     * @dataProvider providerReset
     */
    public function testReset(CoinPreset $coinExpected): void
    {
        CoinPreset::save($coinExpected);
        CoinPreset::reset();
        $coinActual = CoinPreset::get();

        $this->assertEquals(config("app.coin_preset.country"), $coinActual->country);
        $this->assertEquals(config("app.coin_preset.nominal"), $coinActual->nominal);
        $this->assertEquals(config("app.coin_preset.coinage"), $coinActual->coinage);
        $this->assertEquals(config("app.coin_preset.material"), $coinActual->material);
        $this->assertEquals(config("app.coin_preset.currency"), $coinActual->currency);
        $this->assertEquals(config("app.coin_preset.shape"), $coinActual->shape);
        $this->assertEquals(config("app.coin_preset.theme"), $coinActual->theme);
        $this->assertEquals(config("app.coin_preset.year"), $coinActual->year);
        $this->assertEquals(config("app.coin_preset.quality"), $coinActual->quality);
        $this->assertEquals(config("app.coin_preset.storage"), $coinActual->storage);
    }

    /**
     * @return mixed[]
     */
    public function providerReset(): array
    {
        return [
            [
                new CoinPreset(2, 1, 1, 2, 2, 2, 2, 2, "2014", 1, 2)
            ],
        ];
    }
}
