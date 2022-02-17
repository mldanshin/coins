<?php

namespace Tests\Feature\Resources\Views;

use App\Models\LanguageType;
use App\Models\PageIndex;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Filters as FiltersDataProvider;
use Tests\DataProvider\Lang as LangDataProvider;
use Tests\DataProvider\Ordering as OrderingDataProvider;

final class IndexTest extends TestCase
{
    use DatabaseMigrations;
    use FiltersDataProvider;
    use LangDataProvider;
    use OrderingDataProvider;

    public function testSuccess(): void
    {
        $this->seed();

        $this->setLangRu();

        $view = $this->view("index", [
            "page" => PageIndex::create(
                $this->getRequestFilterEmpty(),
                $this->getQueryOrderingEmpty(),
                LanguageType::ru,
                FileStorage::instance()
            ),
            "queryPagination" => "page=1",
            "queryExceptPaginator" => "coin[]=1"
        ]);
        $view->assertSee("Рубль");
        $view->assertSee("Россия");
        $view->assertSee("Юбилейные монеты");
        $view->assertSee("Бронза");
        $view->assertSee("Четырёхугольник");
        $view->assertSee("2013");
        $view->assertSee("?page=1&coin[]=1");
    }
}
