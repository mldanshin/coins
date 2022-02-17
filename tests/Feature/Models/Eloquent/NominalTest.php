<?php

namespace Tests\Feature\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\Eloquent\Nominal;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NominalTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerGetPairCollection
     */
    public function testGetPairCollection(ItemCollection $expected): void
    {
        $this->seed();

        $actual = Nominal::getPairCollection();
        $this->assertTrue($actual->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerGetPairCollection(): array
    {
        return [
            [new ItemCollection(6, "3")],
            [new ItemCollection(20, "500")],
        ];
    }
}
