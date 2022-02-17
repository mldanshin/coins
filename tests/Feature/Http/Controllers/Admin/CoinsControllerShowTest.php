<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;

class CoinsControllerShowTest extends TestCase
{
    use DatabaseMigrations;
    use UserDataProvider;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * @dataProvider providerSuccess
     */
    public function testSuccess(int $coinId): void
    {
        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("admin.coins.show", [$coinId]));

        $response->assertStatus(200);
    }

    /**
     * @return mixed[]
     */
    public function providerSuccess(): array
    {
        return [
            [1],
            [3],
            [7]
        ];
    }

    /**
     * @dataProvider providerWrong
     */
    public function testWrong (int $coinId): void
    {
        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("admin.coins.show", [$coinId]));

        $response->assertStatus(404);
    }

    /**
     * @return mixed[]
     */
    public function providerWrong(): array
    {
        return [
            [101],
            [332],
            [0],
        ];
    }
}
