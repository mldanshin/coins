<?php

namespace Tests\Feature\Models\Download\Pictures;

use App\Models\Download\Repository;
use App\Models\Download\Pictures\CreatorZip;
use App\Models\Download\Pictures\Picture\Picture;
use App\Services\FileStorage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class CreatorZipTest extends TestCase
{
    use StorageDataProvider;

    /**
     * @dataProvider providerCreateSuccess
     * @param Collection<callable> $callbackPictures
     */
    public function testCreateSuccess(callable $callbackPictures): void
    {
        $disk = StorageFacade::fake("public");

        $storage = new FileStorage($disk);
        $repository = new Repository($storage);

        $this->seedStorage();

        $obj = new CreatorZip($repository, $callbackPictures($disk));

        $this->assertInstanceOf(CreatorZip::class, $obj);
        $this->assertFileExists($obj->getFilePath());
    }

    /**
     * @return mixed[]
     */
    public function providerCreateSuccess(): array
    {
        return [
            [
                fn($disk) => collect([
                    new Picture($disk->path("image/4/reverse.png")),
                    new Picture($disk->path("image/6/obverse.svg")),
                ])
            ],
            [
                fn($disk) => collect([
                    new Picture($disk->path("image/1/obverse.ico")),
                    new Picture($disk->path("image/1/reverse.ico")),
                ])
            ]
        ];
    }

    public function testCreateWrong(): void
    {
        $disk = StorageFacade::fake("public");
        $storage = new FileStorage($disk);
        $repository = new Repository($storage);

        $this->seedStorage();

        $obj = new CreatorZip($repository, collect());

        $this->assertNull($obj->getFilePath());
    }
}
