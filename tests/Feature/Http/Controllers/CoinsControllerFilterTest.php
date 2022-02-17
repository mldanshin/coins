<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\BuilderQuery as BuilderQueryDataProvider;

class CoinsControllerFilterTest extends TestCase
{
    use BuilderQueryDataProvider;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * @dataProvider providerSuccess
     * @param mixed[] $data
     */
    public function testSuccess(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        $response->assertStatus(200);
    }

    /**
     * @return mixed[]
     */
    public function providerSuccess(): array
    {
        return [
            [
                []
            ],
            [
                ["search" => "coins"]
            ],
            [
                ["period_first" => "2000", "period_last" => "2010"]
            ],
            [
                ["countries" => ["1"]]
            ],
            [
                ["nominals" => ["1"]]
            ],
            [
                ["coinages" => ["1"]]
            ],
            [
                ["materials" => ["1"]]
            ],
            [
                ["currencies" => ["1"]]
            ],
            [
                ["shapes" => ["1"]]
            ],
            [
                [
                    "nominals" => ["1"],
                    "coinages" => ["2"],
                    "materials" => ["4"],
                    "currencies" => ["2"],
                    "shapes" => ["1"],
                ]
            ],
            [
                [
                    "themes" => ["1"],
                    "mintmarks" => ["1"],
                ]
            ],
        ];
    }

    public function testEmptySuccess(): void
    {
        $response = $this->get(route("index") . "?countries[]=&nominals[]=&coinages[]=&materials[]=&currencies[]=&themes[]=&shapes[]=");
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerWrongSearch
     * @param mixed[] $data
     */
    public function testWrongSearch(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongSearch(): array
    {
        return [
            [
                ["search" => ["blabla"]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongPeriod
     * @param mixed[] $data
     */
    public function testWrongPeriod(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongPeriod(): array
    {
        return [
            [
                [
                    "period_first" => "2010",
                    "period_last" => "2000"
                ]
            ],
            [
                [
                    "period_first" => "2010",
                    "period_last" => "3000"
                ]
            ],
            [
                [
                    "period_first" => "3010",
                    "period_last" => "2010"
                ]
            ],
            [
                [
                    "period_first" => "",
                    "period_last" => "3010"
                ]
            ],
            [
                [
                    "period_first" => ["2000"],
                    "period_last" => ["2010"]
                ]
            ]
        ];
    }

    /**
     * @dataProvider providerWrongCountries
     * @param mixed[] $data
     */
    public function testWrongCountries(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCountries(): array
    {
        return [
            [
                ["countries" => 1],
            ],
            [
                ["countries" => ["blabla", 1, 2]],
            ],
            [
                ["countries[]" => [1]],
            ],
            [
                ["countries" => [100]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongNominals
     * @param mixed[] $data
     */
    public function testWrongNominals(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongNominals(): array
    {
        return [
            [
                ["nominals" => 1],
            ],
            [
                ["nominals" => ["blabla", 1, 2]],
            ],
            [
                ["nominals[]" => [1]],
            ],
            [
                ["nominals" => [100]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongCoinages
     * @param mixed[] $data
     */
    public function testWrongCoinages(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCoinages(): array
    {
        return [
            [
                ["coinages" => 1],
            ],
            [
                ["coinages" => ["blabla", 1, 2]],
            ],
            [
                ["coinages[]" => [1]],
            ],
            [
                ["coinages" => [100]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongMaterials
     * @param mixed[] $data
     */
    public function testWrongMaterials(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongMaterials(): array
    {
        return [
            [
                ["materials" => 1],
            ],
            [
                ["materials" => ["blabla", 1, 2]],
            ],
            [
                ["materials[]" => [1]],
            ],
            [
                ["materials" => [100]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongCurrencies
     * @param mixed[] $data
     */
    public function testWrongCurrencies(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCurrencies(): array
    {
        return [
            [
                ["currencies" => 1],
            ],
            [
                ["currencies" => ["blabla", 1, 2]],
            ],
            [
                ["currencies[]" => [1]],
            ],
            [
                ["currencies" => [100]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongShapes
     * @param mixed[] $data
     */
    public function testWrongShapes(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongShapes(): array
    {
        return [
            [
                ["shapes" => 1],
            ],
            [
                ["shapes" => ["blabla", 1, 2]],
            ],
            [
                ["shapes[]" => [1]],
            ],
            [
                ["shapes" => [100]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongThemes
     * @param mixed[] $data
     */
    public function testWrongThemes(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongThemes(): array
    {
        return [
            [
                ["themes" => 1],
            ],
            [
                ["themes" => ["blabla", 1, 2]],
            ],
            [
                ["themes[]" => [1]],
            ],
            [
                ["themes" => [100]],
            ],
        ];
    }

    /**
     * @dataProvider providerWrongMintmarks
     * @param mixed[] $data
     */
    public function testWrongMintmarks(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongMintmarks(): array
    {
        return [
            [
                ["mintmarks" => 1],
            ],
            [
                ["mintmarks" => ["blabla", 1, 2]],
            ],
            [
                ["mintmarks[]" => [1]],
            ],
            [
                ["mintmarks" => [100]],
            ],
        ];
    }
}
