<?php

namespace Tests\Feature\Support;

use App\Support\DownloadRepository;
use App\Services\FileStorage;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;

class DownloadRepositoryTest extends TestCase
{
    public function testCreateDirectory(): void
    {
        $storage = new FileStorage(StorageFacade::fake("public"));
        $repository = new DownloadRepository($storage);

        $repository->createDirectory("download/");

        $this->assertDirectoryExists($storage->buildPath("download/"));
    }
}
