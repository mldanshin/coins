<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;

class CoinsControllerIndexTest extends TestCase
{
    use DatabaseMigrations;
    use UserDataProvider;

    public function testSuccess(): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("admin.coins.index"));

        $response->assertStatus(200);
    }
}
