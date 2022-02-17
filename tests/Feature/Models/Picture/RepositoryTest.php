<?php

namespace Tests\Feature\Models\Picture;

use App\Models\Picture\Picture;
use App\Models\Picture\Repository;
use App\Services\FileStorage;
use Illuminate\Support\Facades\Storage as  StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Lang as LangDataProvider;
use Tests\DataProvider\Storage as StorageDataProvider;

class RepositoryTest extends TestCase
{
    use LangDataProvider;
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
     * @param mixed[] $coin
     */
    public function testGet(
        array $coin,
        Picture $expected,
        Repository $repository
    ): void {
        $this->seedStorage(StorageFacade::fake("public"));
        $this->setLangRu();

        $actual = $repository->get(
            $coin[0],
            $coin[1],
            $coin[2],
            $coin[3],
            $coin[4],
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerGet(): array
    {
        return [
            [
                [1, "Россия", "1", "Рубль", "2013"],
                new Picture(
                    1,
                    "Монета 1 Рубль 2013, Россия",
                    "storage/image/1/obverse.ico",
                    "storage/image/1/reverse.ico",
                    "storage/image/default.svg"
                )
            ],
            [
                [2, "СССР", "1", "Копейка", "1988"],
                new Picture(
                    2,
                    "Монета 1 Копейка 1988, СССР",
                    "storage/image/2/obverse.png",
                    null,
                    "storage/image/default.svg"
                )
            ],
            [
                [3, "Казахстан", "100", "Тенге", "1998"],
                new Picture(
                    3,
                    "Монета 100 Тенге 1998, Казахстан",
                    null,
                    null,
                    "storage/image/default.svg"
                )
            ]
        ];
    }
}
