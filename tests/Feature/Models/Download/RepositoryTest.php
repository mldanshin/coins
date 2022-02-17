<?php

namespace Tests\Feature\Models\Download;

use App\Models\Download\Repository;
use App\Services\FileStorage;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    public function testCreate(): Repository
    {
        $storage = new FileStorage(StorageFacade::fake("public"));
        $obj = new Repository($storage);

        $this->assertInstanceOf(Repository::class, $obj);

        return $obj;
    }

    public function testCreateInstance(): void
    {
        $obj = Repository::instance();

        $this->assertInstanceOf(Repository::class, $obj);
    }

    /**
     * @depends testCreate
     * @dataProvider providerGetPath
     */
    public function testGetPath(string $fileName, string $expected, Repository $repository): void
    {
        $expected = StorageFacade::fake("public")->path($expected);
        $actual = $repository->getPath($fileName);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerGetPath(): array
    {
        return [
            ["coin_1.pdf", "download/coin_1.pdf"],
            ["file_coin.pdf", "download/file_coin.pdf"]
        ];
    }
}
