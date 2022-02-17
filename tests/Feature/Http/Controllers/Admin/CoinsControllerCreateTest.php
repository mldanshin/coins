<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;

class CoinsControllerCreateTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use UserDataProvider;

    public function testSuccess(): void
    {
        $this->seed();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("admin.coins.create"));

        $response->assertStatus(200);
    }
}
