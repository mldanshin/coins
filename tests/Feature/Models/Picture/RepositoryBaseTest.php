<?php

namespace Tests\Feature\Models\Picture;

use App\Models\Picture\Repository;
use App\Services\FileStorage;
use Illuminate\Support\Facades\Storage as  StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class RepositoryBaseTest extends TestCase
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
    public function testExists(
        string $pathPart,
        bool $expected,
        Repository $repository
    ): void {
        $disk = StorageFacade::fake("public");
        $this->seedStorage($disk);

        $repository->exists($pathPart);

        $this->assertEquals($expected, $disk->exists($pathPart));
    }

    /**
     * @return mixed[]
     */
    public function providerGet(): array
    {
        return [
            ["image/1/obverse.ico", true],
            ["image/10/obverse.ico", false]
        ];
    }
}
