<?php

namespace Tests\Feature\Models\Download\Document;

use App\Models\Download\Document\Manager;
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
    public function testCreate(string $type, ?string $coin): void
    {
        $this->seed();

        $this->seedStorage();
        $this->setConfigFakeDisk();

        $obj = new Manager($type, $coin);

        $this->assertInstanceOf(Manager::class, $obj);
        $this->assertFileExists($obj->getFilePath());
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            ["pdf", "1"],
            ["pdf", "2"],
            ["pdf", null],
        ];
    }
}
