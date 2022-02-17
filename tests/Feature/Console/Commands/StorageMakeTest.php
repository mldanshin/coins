<?php

namespace Tests\Feature\Console\Commands;

use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class StorageMakeTest extends TestCase
{
    use StorageDataProvider;

    public function testSuccess(): void
    {
        $this->setConfigFakeDisk();
        $this->artisan('storage:make')->assertSuccessful();
    }
}
