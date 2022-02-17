<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\LanguageType;
use App\Models\Eloquent\Coin;
use App\Models\Filters\Request\Coin as FilterRequest;
use App\Models\Filters\Request\Search as SearchRequest;
use App\Models\Filters\Request\Period as PeriodRequest;
use App\Models\Ordering\Request as OrderingRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;

class CoinTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;

    /**
     * @dataProvider providerSearch
     */
    public function testSearch(
        FilterRequest $filterRequest,
        OrderingRequest $orderingRequest,
        LanguageType $lang,
        array $expected
    ): void {
        $this->seed();

        $actual = Coin::search($filterRequest, $orderingRequest, $lang)->pluck("id")->all();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerSearch(): array
    {
        return [
            [
                new FilterRequest(
                    new SearchRequest(""),
                    new PeriodRequest(null, null),
                    [1, 2],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ),
                new OrderingRequest(1),
                LanguageType::ru,
                [6, 11, 9, 2, 10, 7, 8, 1]
            ],
            
        ];
    }
}
