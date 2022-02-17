<?php

namespace Tests\Feature\Models\Download\Document;

use App\Models\LanguageType;
use App\Models\Download\Repository;
use App\Models\Download\Document\Coin;
use App\Models\Download\Document\CreatorPdf;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Tests\TestCase;
use Tests\DataProvider\Lang as LangDataProvider;
use Tests\DataProvider\Storage as StorageDataProvider;

class CreatorPdfTest extends TestCase
{
    use DatabaseMigrations;
    use LangDataProvider;
    use StorageDataProvider;
    use RefreshDatabase;

    /**
     * @dataProvider providerCreate
     */
    public function testCreate(string $langTwoLetter, callable $callback): void
    {
        $this->seed();
        $this->setLang($langTwoLetter);

        $storage = new FileStorage(StorageFacade::fake("public"));
        $repository = new Repository($storage);

        $this->seedStorage();

        $obj = new CreatorPdf(
            $repository,
            $callback($storage)
        );

        $this->assertInstanceOf(CreatorPdf::class, $obj);
        $this->assertFileExists($obj->getFilePath());
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            ["ru", fn($storage) => collect([Coin::getById(1, LanguageType::ru, $storage)])],
            ["en", fn($storage) => collect([Coin::getById(1, LanguageType::en, $storage)])],
            ["en", fn($storage) => collect()]
        ];
    }
}
