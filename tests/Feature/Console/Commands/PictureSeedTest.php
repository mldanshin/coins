<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class PictureSeedTest extends TestCase
{
    use DatabaseMigrations;
    use StorageDataProvider;

    public function testSuccess(): void
    {
        $this->seed();
        $this->setConfigFakeDisk();

        $this->artisan('picture:seed')
            ->expectsConfirmation('Executing the delete all your images command, continue?', 'yes')
            ->assertSuccessful();
        $this->artisan('picture:seed')
            ->expectsConfirmation('Executing the delete all your images command, continue?', 'y')
            ->assertSuccessful();
        $this->artisan('picture:seed')
            ->expectsConfirmation('Executing the delete all your images command, continue?', 'no')
            ->assertSuccessful();
    }
}
