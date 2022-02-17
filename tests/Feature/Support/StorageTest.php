<?php

namespace Tests\Feature\Support;

use App\Support\Storage;
use App\Services\FileStorage;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;

class StorageTest extends TestCase
{
    public function testCreateDirectory(): void
    {
        $storage = new FileStorage(StorageFacade::fake("public"));
        $repository = new Storage($storage);

        $repository->createDirectoryIfNotExists();

        $this->assertDirectoryExists($storage->buildPath("download/"));
        $this->assertDirectoryExists($storage->buildPath("image/"));
        $this->assertDirectoryExists($storage->buildPath("image_temp/"));
    }
}
