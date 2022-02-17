<?php

namespace Tests\Feature\Models;

use App\Exceptions\PageNotFoundException;
use App\Models\Validate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidateTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerWrong
     */
    public function testWrong(string $coinId): void
    {
        $this->seed();

        try {
            Validate::coinId($coinId);
        } catch (PageNotFoundException $e) {
            $this->assertInstanceOf(PageNotFoundException::class, $e);
        }
    }

    /**
     * @return mixed[]
     */
    public function providerWrong(): array
    {
        return [
            ["0"],
            ["100"],
            [""],
            ["bla"],
        ];
    }
}
