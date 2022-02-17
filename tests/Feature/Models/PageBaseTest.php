<?php

namespace Tests\Feature\Models;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\PageIndex;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;
use Tests\DataProvider\Ordering as OrderingDataProvider;

class PageBaseTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;
    use OrderingDataProvider;

    public function testCreate(): void
    {
        $this->seed();

        $obj = PageIndex::create(
            $this->getRequestFilterEmpty(),
            $this->getQueryOrderingEmpty(),
            LanguageType::ru,
            FileStorage::instance()
        );

        $this->assertTrue($obj->languages->items->contains(new ItemCollection("ru", "Русский")));
        $this->assertTrue($obj->languages->items->contains(new ItemCollection("en", "English")));
        $this->assertEquals(new ItemCollection("ru", "Русский"), $obj->languages->current);
    }
}
