<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

final class LogControllerTest extends TestCase
{
    /**
     * @dataProvider providerInvoke
     */
    public function testInvoke(string $message): void
    {
        $response = $this->post(route("log"), ["message" => $message]);
        $response->assertStatus(200);
    }

    /**
     * @return array[]
     */
    public function providerInvoke(): array
    {
        return [
            ["Error"],
            ["Exception message"]
        ];
    }
}
