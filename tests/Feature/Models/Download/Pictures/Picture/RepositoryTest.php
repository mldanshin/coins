<?php

namespace Tests\Feature\Models\Download\Pictures\Picture;

use App\Models\Download\Pictures\Picture\Picture;
use App\Models\Download\Pictures\Picture\Repository;
use App\Services\FileStorage;
use Illuminate\Support\Collection;
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
     */
    public function testGetCollection(Repository $repository): void
    {
        $this->seedStorage();

        $actual = $repository->getCollection();

        $this->assertEquals($this->getExpectedCollection(), $actual);
    }

    /**
     * @return Collection<Picture>
     */
    private function getExpectedCollection(): Collection
    {
        $disk = StorageFacade::fake("public");

        $array = [
            new Picture($disk->path("image/1/obverse.ico")),
            new Picture($disk->path("image/1/reverse.ico")),
            new Picture($disk->path("image/2/obverse.png")),
            new Picture($disk->path("image/4/reverse.png")),
            new Picture($disk->path("image/6/obverse.svg")),
        ];

        return collect($array);
    }
}
