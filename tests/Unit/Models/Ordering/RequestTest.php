<?php

namespace Tests\Unit\Models\Ordering;

use App\Models\Ordering\Request;
use Tests\TestCase;

class RequestTest extends TestCase
{
    /**
     * @dataProvider providerCreate
     */
    public function testCreate(?int $value, int $expected): void
    {
        $obj = new Request($value);

        $this->assertInstanceof(Request::class, $obj);
        $this->assertEquals($expected, $obj->value);
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            [1, 1],
            [2, 2],
            [null, 2]
        ];
    }
}
