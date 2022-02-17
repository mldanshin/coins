<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testCreate(): void
    {
        $this->seed();

        $response = $this->get(route("login"));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerStoreSuccess
     */
    public function testStoreSuccess(string $identifier, string $password): void
    {
        $this->seed();

        $response = $this->post(route("login.store"), [
            'identifier' => $identifier,
            'password' => $password,
        ]);
        
        $this->assertAuthenticated();
    }

     /**
     * @return mixed[]
     */
    public function providerStoreSuccess(): array
    {
        return [
            ["a", "1"],
            ["alex", "1990"],
            ["max", "18111979"],
        ];
    }

    /**
     * @dataProvider providerStoreWrong
     */
    public function testStoreWrong(?string $identifier, ?string $password): void
    {
        $this->seed();

        $response = $this->post(route("login.store"), [
            'identifier' => $identifier,
            'password' => $password,
        ]);

        $this->assertGuest();

        $response->assertRedirect(route("index"));
    }

    /**
     * @return array[]
     */
    public function providerStoreWrong(): array
    {
        return [
            ["9991112299", "secret1"],
            [null, "secret1"],
            ["1119991112222", null],
            [null, null],
            ["user", ""],
            ["9991112222", "secret"],
            ["user1", "password"],
            ["9991112222", ""],
            ["", "secret1"],
        ];
    }

    public function testDestroy(): void
    {
        $this->seed();

        $this->post(route("login.store"), [
            'identifier' => "a",
            'password' => "1",
        ]);
        $this->assertAuthenticated();

        $this->post(route("login.destroy"));
        $this->assertGuest();
    }
}
