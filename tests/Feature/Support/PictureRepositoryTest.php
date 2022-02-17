<?php

namespace Tests\Feature\Support;

use App\Services\FileStorage;
use App\Support\PictureRepository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage as  StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class PictureRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use StorageDataProvider;

    public function testCreate(): PictureRepository
    {
        $disk = StorageFacade::fake("public");
        $obj = new PictureRepository(new FileStorage($disk));

        $this->assertInstanceOf(PictureRepository::class, $obj);

        return $obj;
    }

    /**
     * @depends testCreate
     */
    public function testSeed(PictureRepository $repository): void
    {
        $this->seed();

        $repository->seed();

        $this->assertTrue($repository->storage->exists("image/11"));
        $this->assertTrue($repository->storage->exists("image/8"));
        $this->assertTrue($repository->storage->exists("download"));
        $this->assertTrue($repository->storage->exists("image_temp"));
    }

    public function testCreateDirectoriesIfNotExists(): void
    {
        $disk = StorageFacade::fake("public");
        $repository = new PictureRepository(new FileStorage($disk));
        $repository->createDirectoriesIfNotExists();

        $this->assertDirectoryExists($repository->storage->buildPath("image"));
        $this->assertDirectoryExists($repository->storage->buildPath("image_temp"));
    }

    public function testClearTemp(): void
    {
        $countFresh = 4;
        $countOld = 5;

        //prepare
        $this->seed();

        $disk = StorageFacade::fake("public");
        $repository = new PictureRepository(new FileStorage($disk));

        File::cleanDirectory($repository->storage->buildPath("image_temp"));

        $this->prepareFreshFiles($countFresh, $disk);
        $this->prepareOldFiles($countOld, $disk);

        //testing
        $repository->clearTemp();

        //verify
        $files = $disk->files("image_temp");
        $this->assertTrue(count($files) === $countFresh);

        //clearing
        File::cleanDirectory($repository->storage->buildPath("image_temp"));
    }

    private function prepareFreshFiles(int $count, Filesystem $disk): void
    {
        for ($i = 0; $i < $count; $i++) {
            $disk->append("image_temp/fresh{$i}.png", "blabla");
        }
    }

    private function prepareOldFiles(int $count, Filesystem $disk): void
    {
        $timeCurrent = time();
        $timefileStorage = config("app.picture_storage_time");

        for ($i = 0; $i < $count; $i++) {
            $partPath = "image_temp/old{$i}.png";
            $disk->append($partPath, "blabla");
            touch(
                $disk->path($partPath),
                $timeCurrent - ($timefileStorage + 1)
            );
        }
    }
}
