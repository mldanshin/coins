<?php

namespace Tests\Feature\Models\Download\Document\Picture;

use App\Models\Download\Document\Picture\Picture;
use App\Models\Download\Document\Picture\Repository;
use App\Services\FileStorage;
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
        callable $callbackExpectedPicture,
        Repository $repository
    ): void {
        $disk = StorageFacade::fake("public");
        $this->seedStorage();

        $actual = $repository->get($coinId);

        $this->assertEquals($callbackExpectedPicture($disk), $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerGet(): array
    {
        return [
            [
                1,
                fn($disk) => new Picture(
                    $disk->path("image/1/obverse.ico"),
                    $disk->path("image/1/reverse.ico"),
                )
            ],
            [
                2,
                fn($disk) => new Picture(
                    $disk->path("image/2/obverse.png"),
                    null
                )
            ],
            [
                3,
                fn($disk) => new Picture(
                    null,
                    null
                )
            ]
        ];
    }
}
