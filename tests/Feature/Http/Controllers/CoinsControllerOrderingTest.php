<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\BuilderQuery as BuilderQueryDataProvider;

class CoinsControllerOrderingTest extends TestCase
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
                ["ordering" => ""]
            ],
            [
                ["ordering" => "1"]
            ],
            [
                ["ordering" => "2"]
            ],
        ];
    }

    public function testEmptySuccess(): void
    {
        $response = $this->get(route("index") . "?ordering=");
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerWrong
     * @param mixed[] $data
     */
    public function testWrong(array $data): void
    {
        $response = $this->get(route("index") . $this->buildQuery($data));
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerWrong(): array
    {
        return [
            [
                ["ordering" => "blabla"],
            ],
            [
                ["ordering" => -1],
            ],
            [
                ["ordering" => 100],
            ],
        ];
    }
}
