<?php

namespace Tests\Feature\Models\CRUD\Reader;

use App\Models\LanguageType;
use App\Models\CRUD\Reader\PageIndex;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;
use Tests\DataProvider\Ordering as OrderingDataProvider;

class PageIndexTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;
    use OrderingDataProvider;
    use RefreshDatabase;

    public function testCreate(): void
    {
        $this->seed();
        config(["app.admin.paginate" => 5]);

        $obj = PageIndex::create(
            $this->getRequestFilterCRUDEmpty(),
            $this->getQueryOrderingEmpty(),
            LanguageType::ru,
            FileStorage::instance()
        );

        $this->assertEquals(config("app.admin.paginate"), $obj->coins->count());
    }
}
