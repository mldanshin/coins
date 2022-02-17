<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;

class CoinsControllerEditTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use UserDataProvider;

    /**
     * @dataProvider providerSuccess
     */
    public function testSuccess(int $coinId): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("admin.coins.edit", [$coinId]));

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
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("admin.coins.edit", [$coinId]));

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
