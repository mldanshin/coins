<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;

class CoinsControllerPresetTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use UserDataProvider;

    /**
     * @dataProvider providerSavePreset
     * @param mixed[] $data
     */
    public function testSavePresetSuccess(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);

        $response->assertJson(["message" => __("message.preset.ok")]);
    }

    /**
     * @return mixed[]
     */
    public function providerSavePreset(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-mintmark"] = $value;
            return $array;
        };

        return [
            [$data],
            [$func($data, "1")]
        ];
    }

    /**
     * @dataProvider providerWrongCountry
     * @param mixed[] $data
     */
    public function testWrongCountry(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCountry(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-country"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongNominal
     * @param mixed[] $data
     */
    public function testWrongNominal(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongNominal(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-nominal"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongCoinage
     * @param mixed[] $data
     */
    public function testWrongCoinage(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCoinage(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-coinage"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongMaterial
     * @param mixed[] $data
     */
    public function testWrongMaterial(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongMaterial(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-material"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongCurrency
     * @param mixed[] $data
     */
    public function testWrongCurrency(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCurrency(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-currency"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongShape
     * @param mixed[] $data
     */
    public function testWrongShape(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongShape(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-shape"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongTheme
     * @param mixed[] $data
     */
    public function testWrongTheme(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongTheme(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-theme"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongMintmark
     * @param mixed[] $data
     */
    public function testWrongMintmark(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongMintmark(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-mintmark"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongYear
     * @param mixed[] $data
     */
    public function testWrongYear(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongYear(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-year"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
            [$func($data, "10")],
            [$func($data, "100")],
            [$func($data, "10000")],
            [$func($data, "0123")],
        ];
    }

    /**
     * @dataProvider providerWrongQuality
     * @param mixed[] $data
     */
    public function testWrongQuality(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongQuality(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-quality"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @dataProvider providerWrongStorage
     * @param mixed[] $data
     */
    public function testWrongStorage(array $data): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.coins.preset"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongStorage(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-storage"] = $value;
            return $array;
        };

        return [
            [$func($data, "-5")],
            [$func($data, "bla")],
        ];
    }

    /**
     * @return mixed[]
     */
    public function providerInputData(): array
    {
        return [
            "coin-country" => "2",
            "coin-nominal" => "3",
            "coin-coinage" => "1",
            "coin-material" => "3",
            "coin-currency" => "1",
            "coin-shape" => "3",
            "coin-theme" => "2",
            "coin-mintmark" => "",
            "coin-year" => "1015",
            "coin-quality" => "3",
            "coin-storage" => "3"
        ];
    }
}
