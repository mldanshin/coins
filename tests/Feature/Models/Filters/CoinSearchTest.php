<?php

namespace Tests\Feature\Models\Filters;

use App\Models\Filters\CoinSearch;
use App\Models\Filters\Request\Coin as Request;
use App\Models\Filters\Request\Search as SearchRequest;
use App\Models\Filters\Request\Period as PeriodRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CoinSearchTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testCreate(): void
    {
        $obj = new CoinSearch();
        $this->assertInstanceOf(CoinSearch::class, $obj);
    }

    /**
     * @dataProvider providerApply
     * @param int[] $expected
     */
    public function testApply(
        Request $request,
        array $expected
    ): void {
        $actual = (new CoinSearch())->apply($request)->pluck("id")->all();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerApply(): array
    {
        return [
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [3],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                [3, 4]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest("1990", "2010"),
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                [3, 4, 5, 7, 10]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, "1990"),
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [2],
                    []
                ),
                [2, 6]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest("2010", null),
                    [1],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                [1, 8]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [1, 2, 3],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                [1, 2, 3, 4, 6, 7, 8, 9, 10, 11]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [],
                    [2, 3],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                [3, 5, 6]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [],
                    [],
                    [1, 3],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                [2, 5, 6, 7, 8, 9, 10, 11]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [],
                    [],
                    [],
                    [1, 2],
                    [],
                    [],
                    [],
                    []
                ),
                [3]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [],
                    [],
                    [],
                    [],
                    [2, 4],
                    [],
                    [],
                    []
                ),
                [2, 5, 6, 7, 10]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [],
                    [],
                    [],
                    [],
                    [],
                    [2, 4],
                    [],
                    []
                ),
                [4, 7, 8, 9]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [1],
                    []
                ),
                [1, 8, 9, 11]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [1, 3]
                ),
                [1]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [1],
                    [9],
                    [1],
                    [2],
                    [3],
                    [5],
                    [1],
                    [2]
                ),
                []
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [1],
                    [10],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                [1]
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [1],
                    [9],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                []
            ],
            [
                new Request(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [1, 3],
                    [4],
                    [],
                    [],
                    [],
                    [],
                    [1],
                    []
                ),
                [8]
            ],
        ];
    }
}
