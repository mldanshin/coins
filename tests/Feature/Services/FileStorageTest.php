<?php

namespace Tests\Feature\Services;

use App\Services\FileStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage as  StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class FileStorageTest extends TestCase
{
    use StorageDataProvider;

    public function testCreate(): FileStorage
    {
        $disk = StorageFacade::fake("public");
        $obj = new FileStorage($disk);

        $this->assertInstanceOf(FileStorage::class, $obj);

        return $obj;
    }

    public function testCreateDirectory(): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);

        $this->seedStorage($disk);
        $pathPart = "image/20";

        $storage->createDirectory($pathPart);

        $this->assertTrue($disk->exists($pathPart));
    }

    public function testCreateDirectoryBase(): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);

        $storage->createDirectoryBase();

        $this->assertDirectoryExists($disk->path(""));
    }

    /**
     * @dataProvider providerExists
     */
    public function testExists(string $pathPart, bool $expected): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);

        $this->seedStorage($disk);

        $res = $storage->exists($pathPart);

        $this->assertEquals($expected, $res);
    }

    /**
     * @return mixed[]
     */
    public function providerExists(): array
    {
        return [
            ["image/1/obverse.ico", true],
            ["image/2/obverse.png", true],
            ["image/3/obverse.jpg", false],
            ["image/4/reverse.jpg", false]
        ];
    }

    public function testPutFile(): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);

        $this->seedStorage($disk);
        $fileUpload = new UploadedFile($this->getPathFile(), "blabla.svg");

        $file = $storage->putFile("image_temp/", $fileUpload);

        $disk->assertExists("image_temp/$file");
    }

    /**
     * @dataProvider providerMove
     */
    public function testMove(string $pathFrom, string $pathTo): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);

        $this->seedStorage($disk);

        $storage->move($pathFrom, $pathTo);

        $this->assertFalse(File::exists($storage->buildPath($pathFrom)));
        $this->assertTrue(File::exists($storage->buildPath($pathTo)));
    }

    /**
     * @return mixed[]
     */
    public function providerMove(): array
    {
        
        return [
            ["image/1/obverse.ico", "image/3/obverse.ico"],
            ["image_temp/qwe.svg", "image/5/obverse.svg"],
            ["image_temp/qwe.svg", "image/6/obverse.svg"],
        ];
    }

    /**
     * @dataProvider providerDelete
     */
    public function testDelete(string $pathPart): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);

        $this->seedStorage($disk);

        $storage->delete($pathPart);

        $this->assertFalse($disk->exists("image/$pathPart"));
    }

    /**
     * @return mixed[]
     */
    public function providerDelete(): array
    {
        return [
            ["image/1/obverse.ico"],
            ["image/1/reverse.ico"],
            ["image/2/obverse.ico"],
            ["image/3/1.jpg"],
        ];
    }

    /**
     * @dataProvider providerDeleteDirectory
     */
    public function testDeleteDirectory(string $pathPart): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);

        $this->seedStorage($disk);

        $storage->deleteDirectory($pathPart);

        $this->assertFalse($disk->exists($pathPart));
    }

    /**
     * @return mixed[]
     */
    public function providerDeleteDirectory(): array
    {
        return [
            ["image/1"],
            ["image/2"],
            ["image/12"],
        ];
    }
}
