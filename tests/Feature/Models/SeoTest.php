<?php

namespace Tests\Feature\Models;

use App\Models\Seo;
use App\Models\LanguageType;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\Seo as SeoEloquent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetByCoinEloquent
     * @param mixed[] $data
     */
    public function testGetByCoinEloquent(int $coinId, ?Seo $seo): void
    {
        $this->seed();

        $obj = Seo::getByCoinEloquent(CoinEloquent::find($coinId), LanguageType::ru);
            $this->assertEquals($seo, $obj);
    }

    /**
     * @return mixed[]
     */
    public function providerGetByCoinEloquent(): array
    {
        return [
            [
                1,
                new Seo(
                    1,
                    "Рубль России",
                    "Рубль России выпускается Банком России",
                    "Валюта России"
                ),
            ],
            [
                2,
                null
            ],
        ];
    }

    public function testDefault(): void
    {
        $this->seed();

        $obj = Seo::getDefault();
        $this->assertEquals(__("page-index.title"), $obj->title);
        $this->assertEquals(__("page-index.description"), $obj->description);
        $this->assertEquals(__("page-index.keywords"), $obj->keywords);
    }

    public function testEmpty(): void
    {
        $this->seed();

        $obj = Seo::getEmpty();
        $this->assertEquals("", $obj->title);
        $this->assertEquals("", $obj->description);
        $this->assertEquals("", $obj->keywords);
    }

    /**
     * @dataProvider providerStore
     */
    public function testStore(int $coinId, Seo $seo, LanguageType $lang): void
    {
        $this->seed();

        $id = Seo::storeOrUpdate($coinId, $seo, $lang);

        $seoEloquent = SeoEloquent::find($id)->translate($lang);
        $this->assertEquals($seo->title, $seoEloquent->title);
        $this->assertEquals($seo->description, $seoEloquent->description);
        $this->assertEquals($seo->keywords, $seoEloquent->keywords);
    }

    /**
     * @return mixed[]
     */
    public function providerStore(): array
    {
        return [
            [
                2,
                new Seo(0, "Это статья про монеты", "Монеты являются денежными средствами", "Монеты, статья про монеты"),
                LanguageType::ru
            ],
        ];
    }

    /**
     * @dataProvider providerUpdate
     */
    public function testUpdate(int $coinId, Seo $seo, LanguageType $lang): void
    {
        $this->seed();

        $id = Seo::storeOrUpdate($coinId, $seo, $lang);

        $seoEloquent = SeoEloquent::find($id)->translate($lang);
        $this->assertEquals($seo->title, $seoEloquent->title);
        $this->assertEquals($seo->description, $seoEloquent->description);
        $this->assertEquals($seo->keywords, $seoEloquent->keywords);

        $this->assertFalse($seo->id === $seoEloquent->language_id);
        $this->assertFalse($seoEloquent->where("title", "Рубль России")->exists());
    }

    /**
     * @return mixed[]
     */
    public function providerUpdate(): array
    {
        return [
            [
                1,
                new Seo(0, "Это статья про монеты", "Монеты являются денежными средствами", "Монеты, статья про монеты"),
                LanguageType::ru
            ],
        ];
    }

    /**
     * @dataProvider providerDelete
     */
    public function testDelete(int $coinId): void
    {
        $this->seed();

        Seo::delete($coinId);

        $this->assertFalse(SeoEloquent::where("coin_id", $coinId)->exists());
    }

    /**
     * @return mixed[]
     */
    public function providerDelete(): array
    {
        return [
            [1],
            [5]
        ];
    }
}
