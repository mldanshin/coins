<?php

namespace Tests\Feature\Models\CRUD\Saving;

use App\Models\CRUD\Saving\Coin;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Eloquent\CoinMintmark as CoinMintmarkEloquent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoinTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerStore
     */
    public function testStore(Coin $coin): void
    {
        $this->seed();

        $id = Coin::store($coin);

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
    public function providerStore(): array
    {
        return [
            [
                new Coin(1, 10, 2, 3, 1, 1, 1, 1, "2013", 2, 1)
            ],
            [
                new Coin(3, 2, 2, 1, 3, 1, 2, null, "1998", 1, 2)
            ],
        ];
    }
}
