<?php

namespace Tests\Feature\Models\CRUD\Picture;

use App\Models\CRUD\Picture\PictureUpload;
use App\Models\CRUD\Picture\Repository;
use App\Models\CRUD\Editor\Picture\Picture as PictureEditor;
use App\Models\CRUD\Editor\Picture\Source;
use App\Models\CRUD\Saving\Picture as PictureSaving;
use App\Models\CRUD\Updater\Picture as PictureUpdater;
use App\Models\Picture\PictureType;
use App\Services\FileStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage as  StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class RepositoryTest extends TestCase
{
    use StorageDataProvider;

    public function testCreate(): Repository
    {
        $obj = new Repository(
            new FileStorage(StorageFacade::fake("public"))
        );
        $this->assertInstanceOf(Repository::class, $obj);
        return $obj;
    }

    /**
     * @depends testCreate
     * @dataProvider providerGet
     */
    public function testGet(
        int $coinId,
        PictureEditor $expected,
        Repository $repository
    ): void {
        $this->seedStorage();

        $actual = $repository->getEditor($coinId);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerGet(): array
    {
        return [
            [
                1,
                new PictureEditor(
                    1,
                    new Source("image/1/obverse.ico", "storage/image/1/obverse.ico", PictureType::obverse),
                    new Source("image/1/reverse.ico", "storage/image/1/reverse.ico", PictureType::reverse)
                )
            ],
            [
                2,
                new PictureEditor(
                    2,
                    new Source("image/2/obverse.png", "storage/image/2/obverse.png", PictureType::obverse),
                    null
                )
            ],
            [
                3,
                new PictureEditor(
                    3,
                    null,
                    null
                )
            ]
        ];
    }

    /**
     * @depends testCreate
     */
    public function testUpload(Repository $repository): void
    {
        $this->seedStorage();
        $fileUpload = new UploadedFile($this->getPathFile(), "blabla.svg");

        $source = $repository->upload(new PictureUpload($fileUpload, PictureType::obverse));

        $this->assertTrue(str_contains($source->inside, "image_temp/"));
        $this->assertTrue(str_contains($source->outside, "storage/image_temp/"));
        $this->assertEquals(PictureType::obverse, $source->type);
    }

    /**
     * @depends testCreate
     */
    public function testStore_Nothing(Repository $repository): void
    {
        $disk = StorageFacade::fake("public");
        $this->seedStorage();

        $picture = new PictureSaving(
            null,
            null
        );

        $repository->store(34, $picture);

        $this->assertDirectoryExists($disk->path("image/34"));
        $this->assertEquals(0, count($disk->allFiles("image/34")));
    }

    /**
     * @depends testCreate
     */
    public function testStore(Repository $repository): void
    {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $picture = new PictureSaving(
            "image_temp/new1.svg",
            "image_temp/new2.svg"
        );

        $repository->store(34, $picture);

        $this->assertFileExists($disk->path("image/34/obverse.svg"));
        $this->assertFileExists($disk->path("image/34/reverse.svg"));
    }

    /**
     * @depends testCreate
     */
    public function testUpdate_Nothing(Repository $repository): void
    {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $picture = new PictureUpdater(
            1,
            "image/1/obverse.ico",
            "image/1/reverse.ico"
        );

        $repository->update($picture);

        $this->assertFileExists($disk->path("image/1/obverse.ico"));
        $this->assertFileExists($disk->path("image/1/reverse.ico"));
    }

    /**
     * @depends testCreate
     */
    public function testUpdate_DeleteObverse(Repository $repository): void
    {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $picture = new PictureUpdater(
            1,
            null,
            "image/1/reverse.ico"
        );

        $repository->update($picture);

        $this->assertFileDoesNotExist($disk->path("image/1/obverse.ico"));
        $this->assertFileExists($disk->path("image/1/reverse.ico"));
    }

    /**
     * @depends testCreate
     */
    public function testUpdate_DeleteReverse(Repository $repository): void
    {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $picture = new PictureUpdater(
            1,
            "image/1/obverse.ico",
            null
        );

        $repository->update($picture);

        $this->assertFileDoesNotExist($disk->path("image/1/reverse.ico"));
        $this->assertFileExists($disk->path("image/1/obverse.ico"));
    }

    /**
     * @depends testCreate
     */
    public function testUpdate_DeleteAll(Repository $repository): void
    {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $picture = new PictureUpdater(
            1,
            null,
            null
        );

        $repository->update($picture);

        $this->assertFileDoesNotExist($disk->path("image/1/reverse.ico"));
        $this->assertFileDoesNotExist($disk->path("image/1/obverse.ico"));
    }

    /**
     * @depends testCreate
     */
    public function testUpdate_Move(Repository $repository): void
    {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $picture = new PictureUpdater(
            1,
            "image/1/obverse.ico",
            "image_temp/qwe.svg"
        );

        $repository->update($picture);

        $this->assertFileDoesNotExist($disk->path("image_temp/qwe.svg"));
        $this->assertFileExists($disk->path("image/1/obverse.ico"));
        $this->assertFileExists($disk->path("image/1/reverse.svg"));
    }

    /**
     * @depends testCreate
     * @dataProvider providerDelete
     */
    public function testDelete(
        int $coinId,
        string $directory,
        Repository $repository
    ): void {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $repository->delete($coinId);

        $this->assertFileDoesNotExist($disk->path($directory));
    }

    /**
     * @return mixed[]
     */
    public function providerDelete(): array
    {
        return [
            [1, "image/1"],
            [2, "image/2"]
        ];
    }
}
