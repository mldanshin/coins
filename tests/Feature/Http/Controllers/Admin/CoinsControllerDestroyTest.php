<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Eloquent\Coin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class CoinsControllerDestroyTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use StorageDataProvider;
    use UserDataProvider;

    /**
     * @dataProvider providerSuccess
     */
    public function testSuccess(int $coinId): void
    {
        $this->seed();
        $this->setConfigFakeDisk();
        $this->seedStorage();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->delete(route("admin.coins.destroy", [$coinId]));
        $response->assertRedirect(route("admin.index"));

        $this->assertFalse(Coin::where("id", $coinId)->exists());
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
    public function testWrong(int $coinId): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->delete(route("admin.coins.destroy", [$coinId]));

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
