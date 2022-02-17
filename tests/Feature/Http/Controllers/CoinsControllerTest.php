<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CoinsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testIndexSuccess(): void
    {
        $response = $this->get(route("index"));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerShowSuccess
     */
    public function testShowSuccess(int $coinId): void
    {
        $response = $this->get(route("show", $coinId));
        $response->assertStatus(200);
    }

    /**
     * @return mixed[]
     */
    public function providerShowSuccess(): array
    {
        return [
            [1],
            [3],
            [5]
        ];
    }

    /**
     * @dataProvider providerWrongCoin
     */
    public function testShowWrongCoin(int $coinId): void
    {
        $response = $this->get(route("show", $coinId));
        $response->assertStatus(404);
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCoin(): array
    {
        return [
            [100],
            [0],
            [300]
        ];
    }
}
