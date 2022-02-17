<?php

namespace Tests\Feature\Models;

use App\Models\LanguageType;
use App\Models\PageIndex;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;
use Tests\DataProvider\Ordering as OrderingDataProvider;

class PageIndexTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;
    use OrderingDataProvider;

    public function testCreate(): void
    {
        $this->seed();
        config(["app.front.paginate" => 10]);

        $obj = PageIndex::create(
            $this->getRequestFilterEmpty(),
            $this->getQueryOrderingEmpty(),
            LanguageType::ru,
            FileStorage::instance()
        );

        $this->assertEquals(config("app.front.paginate"), $obj->coins->count());
        $this->assertEquals(__("page-index.title"), $obj->seo->title);
        $this->assertEquals(__("page-index.description"), $obj->seo->description);
        $this->assertEquals(__("page-index.keywords"), $obj->seo->keywords);
    }
}
