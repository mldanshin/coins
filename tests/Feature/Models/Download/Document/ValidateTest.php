<?php

namespace Tests\Feature\Models\Download\Document;

use App\Exceptions\PageNotFoundException;
use App\Models\Download\Document\Validate;
use Tests\TestCase;

class ValidateTest extends TestCase
{
    /**
     * @dataProvider providerTypeSuccess
     */
    public function testTypeSuccess(string $type): void
    {
        $this->assertTrue(Validate::type($type));
    }

    /**
     * @return mixed[]
     */
    public function providerTypeSuccess(): array
    {
        return [
            ["pdf"],
        ];
    }

    /**
     * @dataProvider providerTypeWrong
     */
    public function testTypeWrong(string $type): void
    {
        try {
            Validate::type($type);
        } catch (PageNotFoundException $e) {
            $this->assertInstanceOf(PageNotFoundException::class, $e);
        }
    }

    /**
     * @return mixed[]
     */
    public function providerTypeWrong(): array
    {
        return [
            ["pddf"],
            ["xxml"],
            [""],
            ["bla"],
        ];
    }
}
