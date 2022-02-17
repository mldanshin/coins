<?php

namespace Tests\Feature\Resources\Views\Admin\Reader;

use App\Models\LanguageType;
use App\Models\CRUD\Reader\PageIndex;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    use RefreshDatabase;

    public function testSuccess(): void
    {
        $this->seed();

        $this->setLangRu();

        $view = $this->view("admin.index", [
            "page" => PageIndex::create(
                $this->getRequestFilterCRUDEmpty(),
                $this->getQueryOrderingEmpty(),
                LanguageType::ru,
                FileStorage::instance()
            ),
            "queryExceptPaginator" => "?page=1&category=1"
        ]);
        $view->assertSee("Рубль");
        $view->assertSee("Россия");
        $view->assertSee("Юбилейные монеты");
        $view->assertSee("Бронза");
        $view->assertSee("Четырёхугольник");
        $view->assertSee("2013");
        $view->assertSee("Удовлетворительное");
        $view->assertSee("10");
        $view->assertSee("Имеются SEO данные");
        $view->assertSee("?page=1&category=1");
    }
}
