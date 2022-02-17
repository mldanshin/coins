<?php

namespace Tests\Feature\Models\Ordering;

use App\Models\LanguageType;
use App\Models\Eloquent\Coin;
use App\Models\Ordering\CoinOrdering;
use App\Models\Ordering\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CoinOrderingTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate(): void
    {
        $obj = new CoinOrdering((new Coin())->newQuery());
        $this->assertInstanceof(CoinOrdering::class, $obj);
    }

    /**
     * @dataProvider providerApply
     * @param int[] $expected
     */
    public function testApply(
        Request $request,
        LanguageType $lang,
        array $expected
    ): void {
        $this->seed();

        $obj = new CoinOrdering((new Coin())->newQuery());
        $actual = $obj->apply($request, $lang)->pluck("coins.id")->all();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerApply(): array
    {
        return [
            [
                new Request(null),
                LanguageType::ru,
                [5, 6, 2, 7, 10, 8, 11, 9, 1, 3, 4]
            ],
            [
                new Request(1),
                LanguageType::ru,
                [6, 11, 9, 2, 3, 10, 7, 5, 4, 8, 1]
            ],
            [
                new Request(2),
                LanguageType::ru,
                [5, 6, 2, 7, 10, 8, 11, 9, 1, 3, 4]
            ]
        ];
    }
}
