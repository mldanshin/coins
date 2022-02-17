<?php

namespace Tests\Feature\Models\Download\Database;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class CreatorTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use StorageDataProvider;

    public function testCreate(): void
    {
        $this->markTestSkipped(
            "The text is skipped because testing goes through sqlite in memory, the dump of which could not be obtained, and I consider it superfluous to write in the working code getting a dump only because of the test."
        );
    }
}
