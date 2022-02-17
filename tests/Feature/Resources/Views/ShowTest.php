<?php

namespace Tests\Feature\Resources\Views;

use App\Models\LanguageType;
use App\Models\PageShow;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\DataProvider\Lang as LangDataProvider;

final class ShowTest extends TestCase
{
    use DatabaseMigrations;
    use LangDataProvider;
    use RefreshDatabase;

    public function testSuccess(): void
    {
        $this->seed();

        $this->setLangRu();

        $view = $this->view("show", [
            "page" => PageShow::create(1, LanguageType::ru, FileStorage::instance()),
            "query" => "?pages=13"
        ]);
        $view->assertSee("Рубль");
        $view->assertSee("Россия");
        $view->assertSee("Юбилейные монеты");
        $view->assertSee("Бронза");
        $view->assertSee("Четырёхугольник");
        $view->assertSee("2013");
        $view->assertSee("?pages=13");
    }
}
