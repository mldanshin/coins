<?php

namespace Tests\Feature\Models\Download\Pictures;

use App\Models\Download\Pictures\Manager;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class ManagerTest extends TestCase
{
    use DatabaseMigrations;
    use StorageDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerCreate
     */
    public function testCreate(string $type): void
    {
        $this->seed();

        $this->seedStorage();
        $this->setConfigFakeDisk();

        $obj = new Manager($type);

        $this->assertInstanceOf(Manager::class, $obj);
        $this->assertFileExists($obj->getFilePath());
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            ["zip"],
        ];
    }
}
