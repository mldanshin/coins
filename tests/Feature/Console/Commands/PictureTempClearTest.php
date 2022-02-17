<?php

namespace Tests\Feature\Console\Commands;

use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class PictureTempClearTest extends TestCase
{
    use StorageDataProvider;

    public function testSuccess(): void
    {
        $this->setConfigFakeDisk();

        $this->artisan('picture:clear')->assertSuccessful();
    }
}
