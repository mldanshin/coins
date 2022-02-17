<?php

namespace Tests\Feature\Models\CRUD\Editor;

use App\Models\CoinParameters;
use App\Models\LanguageType;
use App\Models\CRUD\CoinPreset;
use App\Models\CRUD\Editor\Coin;
use App\Models\CRUD\Editor\Picture\Picture;
use App\Models\CRUD\Editor\Picture\Source;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Models\Picture\PictureType;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage as  StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class CoinTest extends TestCase
{
    use DatabaseMigrations;
    use StorageDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetByEloquent
     */
    public function testGetByEloquent(
        int $coinId,
        CoinPreset $old,
        Coin $expected
    ): void {
        $this->seed();

        $disk = StorageFacade::fake("public");
        $this->seedStorage();

        $coinEloquent = CoinEloquent::find($coinId);
        $coinParameters = new CoinParameters(LanguageType::ru);

        $obj = Coin::getByEloquent($coinEloquent, $old, $coinParameters, new FileStorage($disk));

        $this->assertEquals($expected->id, $obj->id);
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
        $this->assertEquals($expected->picture, $obj->picture);
    }

    /**
     * @return mixed[]
     */
    public function providerGetByEloquent(): array
    {
        return [
            [
                1,
                new CoinPreset(1, null, 2, 3, null, 2, null, null, "2022", 2, 1),
                new Coin(1, 1, 10, 2, 3, 1, 2, 1, 1, "2022", 2, 1, 
                    new CoinParameters(LanguageType::ru),
                    new Picture(
                        1,
                        new Source(
                            "image/1/obverse.ico",
                            "storage/image/1/obverse.ico",
                            PictureType::obverse
                        ),
                        new Source(
                            "image/1/reverse.ico",
                            "storage/image/1/reverse.ico",
                            PictureType::reverse
                            )
                    ),
                ),
            ],
            [
                3,
                new CoinPreset(1, null, 2, 3, null, 2, null, null, null, 2, 1),
                new Coin(3, 1, 2, 2, 3, 3, 2, 2, null, "1998", 2, 1, 
                    new CoinParameters(LanguageType::ru),
                    new Picture(
                        3,
                        null,
                        null
                    ),
                ),
            ]
        ];
    }
}
