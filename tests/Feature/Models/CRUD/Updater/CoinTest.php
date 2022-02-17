<?php

namespace Tests\Feature\Models\CRUD\Updater;

use App\Models\CRUD\Updater\Coin;
use App\Models\Eloquent\Article as ArticleEloquent;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\CoinMintmark as CoinMintmarkEloquent;
use App\Models\Eloquent\Seo as SeoEloquent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoinTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerUpdate
     */
    public function testUpdate(Coin $coin): void
    {
        $this->seed();

        $id = Coin::update($coin);

        $coinEloquent = CoinEloquent::find($id);
        $this->assertEquals($coin->country, $coinEloquent->country_id);
        $this->assertEquals($coin->nominal, $coinEloquent->nominal_id);
        $this->assertEquals($coin->coinage, $coinEloquent->coinage_id);
        $this->assertEquals($coin->material, $coinEloquent->material_id);
        $this->assertEquals($coin->currency, $coinEloquent->currency_id);
        $this->assertEquals($coin->shape, $coinEloquent->shape_id);
        $this->assertEquals($coin->theme, $coinEloquent->theme_id);
        $this->assertEquals($coin->year, $coinEloquent->year);
        $this->assertEquals($coin->quality, $coinEloquent->quality_id);
        $this->assertEquals($coin->storage, $coinEloquent->storage_id);

        if ($coin->mintmark === null) {
            $this->assertFalse(CoinMintmarkEloquent::where("coin_id", $id)->exists());
        } else {
            $this->assertTrue(CoinMintmarkEloquent::where("coin_id", $id)->exists());
        }
    }

    /**
     * @return mixed[]
     */
    public function providerUpdate(): array
    {
        return [
            [
                new Coin(1, 2, 1, 1, 2, 2, 2, 2, 2, "2014", 1, 2)
            ],
        ];
    }

    /**
     * @dataProvider providerDelete
     */
    public function testDelete(int $id): void
    {
        $this->seed();

        Coin::delete($id);

        $this->assertFalse(CoinEloquent::where("id", $id)->exists());
        $this->assertFalse(ArticleEloquent::where("coin_id", $id)->exists());
        $this->assertFalse(CoinMintmarkEloquent::where("coin_id", $id)->exists());
        $this->assertFalse(SeoEloquent::where("coin_id", $id)->exists());
    }

    /**
     * @return mixed[]
     */
    public function providerDelete(): array
    {
        return [
            [1],
            [2],
            [5],
            [6]
        ];
    }
}
