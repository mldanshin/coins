<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Eloquent\Coin;
use App\Models\Eloquent\CoinMintmark;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class CoinsControllerUpdateTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use StorageDataProvider;
    use UserDataProvider;

    /**
     * @dataProvider providerUpdateSuccess
     * @param mixed[] $data
     */
    public function testUpdateSuccess(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);

        $response->assertRedirect(route("admin.coins.show", $data["coin-id"]));

        $coinActual = Coin::find($data["coin-id"]);
        $this->assertEquals($data["coin-country"], $coinActual->country_id);
        $this->assertEquals($data["coin-nominal"], $coinActual->nominal_id);
        $this->assertEquals($data["coin-coinage"], $coinActual->coinage_id);
        $this->assertEquals($data["coin-material"], $coinActual->material_id);
        $this->assertEquals($data["coin-currency"], $coinActual->currency_id);
        $this->assertEquals($data["coin-shape"], $coinActual->shape_id);
        $this->assertEquals($data["coin-theme"], $coinActual->theme_id);
        $this->assertEquals($data["coin-year"], $coinActual->year);
        $this->assertEquals($data["coin-quality"], $coinActual->quality_id);
        $this->assertEquals($data["coin-storage"], $coinActual->storage_id);

        if (empty($data["coin-mintmark"])) {
            $this->assertFalse(CoinMintmark::where("coin_id", $data["coin-id"])->exists());
        } else {
            $this->assertTrue(CoinMintmark::where("coin_id", $data["coin-id"])->exists());
        }
    }

    /**
     * @return mixed[]
     */
    public function providerUpdateSuccess(): array
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
     * @dataProvider providerWrongId
     * @param mixed[] $data
     */
    public function testWrongId(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $routeCoinId = (empty($data["coin-id"])) ? 1 : $data["coin-id"];

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $routeCoinId), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongId(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $value) {
            $array["coin-id"] = $value;
            return $array;
        };

        return [
            [$func($data, "56")],
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerWrongCountry
     * @param mixed[] $data
     */
    public function testWrongCountry(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerWrongNominal
     * @param mixed[] $data
     */
    public function testWrongNominal(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerWrongCoinage
     * @param mixed[] $data
     */
    public function testWrongCoinage(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerWrongMaterial
     * @param mixed[] $data
     */
    public function testWrongMaterial(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerWrongCurrency
     * @param mixed[] $data
     */
    public function testWrongCurrency(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
            [$func($data, "3")],
            [$func($data, "4")],
        ];
    }

    /**
     * @dataProvider providerWrongShape
     * @param mixed[] $data
     */
    public function testWrongShape(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerWrongTheme
     * @param mixed[] $data
     */
    public function testWrongTheme(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerWrongMintmark
     * @param mixed[] $data
     */
    public function testWrongMintmark(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
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
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerSuccessPicture
     * @param mixed[] $data
     */
    public function testSuccessPicture(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();
        $this->seedStorage();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
        $response->assertRedirect(route("admin.coins.show", $data["coin-id"]));
    }

    /**
     * @return mixed[]
     */
    public function providerSuccessPicture(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $valueObverse, $valueReverse) {
            $array["picture-obverse"] = $valueObverse;
            $array["picture-reverse"] = $valueReverse;
            return $array;
        };

        return [
            [$func($data, null, null)],
            [$func($data, "image/1/obverse.ico", null)],
            [$func($data, null, "image/4/reverse.png")],
        ];
    }

    /**
     * @dataProvider providerWrongPicture
     * @param mixed[] $data
     */
    public function testWrongPicture(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongPicture(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $valueObverse, $valueReverse) {
            $array["picture-obverse"] = $valueObverse;
            $array["picture-reverse"] = $valueReverse;
            return $array;
        };

        return [
            [$func($data, "img/1/bla.jpg", null)],
            [$func($data, null, "img_temp/1/bla.jpg")],
        ];
    }

    /**
     * @dataProvider providerWrongStorage
     * @param mixed[] $data
     */
    public function testWrongStorage(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
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
            [$func($data, "")],
            [$func($data, "bla")],
            [$func($data, null)],
        ];
    }

    /**
     * @dataProvider providerSuccessSeo
     * @param mixed[] $data
     */
    public function testSuccessSeo(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
        $response->assertRedirect(route("admin.coins.show", $data["coin-id"]));
    }

    /**
     * @return mixed[]
     */
    public function providerSuccessSeo(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $title, $description, $keywords) {
            $array["seo-title"] = $title;
            $array["seo-description"] = $description;
            $array["seo-keywords"] = $keywords;
            return $array;
        };

        return [
            [$func($data, "Тенге из Казахстана", "Национальная валюта Казахстана", "Валюта Казахстана")],
            [$func($data, null, null, null)],
            [$func($data, "", "", "")],
        ];
    }

    /**
     * @dataProvider providerWrongSeo
     * @param mixed[] $data
     */
    public function testWrongSeo(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongSeo(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $title, $description, $keywords) {
            $array["seo-title"] = $title;
            $array["seo-description"] = $description;
            $array["seo-keywords"] = $keywords;
            return $array;
        };

        return [
            [$func($data, $this->generateString(100), $this->generateString(400), $this->generateString(300))],
            [$func($data, "blabla", null, null)],
            [$func($data, null, "blabla", null)],
            [$func($data, null, null, "blabla")],
            [$func($data, null, "blabla", "blabla")],
            [$func($data, "blabla", null, "blabla")],
            [$func($data, "blabla", "blabla", null)],
        ];
    }

    /**
     * @dataProvider providerSuccessArticle
     * @param mixed[] $data
     */
    public function testSuccessArticle(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
        $response->assertRedirect(route("admin.coins.show", $data["coin-id"]));
    }

    /**
     * @return mixed[]
     */
    public function providerSuccessArticle(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $title, $content) {
            $array["article-title"] = $title;
            $array["article-content"] = $content;
            return $array;
        };

        return [
            [$func($data, "Статья про рубль", "Здесь находится содержание статьи")],
            [$func($data, null, null)],
            [$func($data, "", "")],
        ];
    }

    /**
     * @dataProvider providerWrongArticle
     * @param mixed[] $data
     */
    public function testWrongArticle(array $data): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->put(route("admin.coins.update", $data["coin-id"]), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongArticle(): array
    {
        $data = $this->providerInputData();

        $func = function ($array, $title, $content) {
            $array["article-title"] = $title;
            $array["article-content"] = $content;
            return $array;
        };

        return [
            [$func($data, $this->generateString(200), "blabla")],
            [$func($data, "blabla", null)],
            [$func($data, null, "blabla")],
        ];
    }

    /**
     * @return mixed[]
     */
    public function providerInputData(): array
    {
        return [
            "coin-id" => "1",
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
            "coin-storage" => "3",

            "seo-title" => "",
            "seo-description" => "",
            "seo-keywords" => "",

            "article-title" => "",
            "article-content" => "",
        ];
    }

    private function generateString(int $count): string
    {
        $string = "";
        for ($i = 0; $i < $count; $i++) {
            $string .= "a";
        }
        return $string;
    }
}
