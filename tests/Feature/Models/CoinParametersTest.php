<?php

namespace Tests\Feature\Models;

use App\Models\CoinParameters;
use App\Models\ItemCollection;
use App\Models\LanguageType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CoinParametersTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetByEloquent(): void
    {
        $this->seed();

        $obj = new CoinParameters(LanguageType::ru);

        $this->assertTrue($obj->countries()->contains(new ItemCollection("1", "Россия")));
        $this->assertTrue($obj->nominals()->contains(new ItemCollection(3, 1)));
        $this->assertTrue($obj->nominals()->contains(new ItemCollection(10, "7.5")));
        $this->assertTrue($obj->coinages()->contains(new ItemCollection(4, "Пробники(токены)")));
        $this->assertTrue($obj->coinages()->contains(new ItemCollection(2, "Юбилейные монеты")));
        $this->assertTrue($obj->materials()->contains(new ItemCollection(1, "Алюминиевая бронза")));
        $this->assertTrue($obj->materials()->contains(new ItemCollection(3, "Бронза")));
        $this->assertTrue($obj->currencies()->contains(new ItemCollection(3, "Тенге")));
        $this->assertTrue($obj->currencies()->contains(new ItemCollection(1, "Рубль")));
        $this->assertTrue($obj->shapes()->contains(new ItemCollection(2, "Круг")));
        $this->assertTrue($obj->shapes()->contains(new ItemCollection(1, "Четырёхугольник")));
        $this->assertTrue($obj->themes()->contains(new ItemCollection(2, "География")));
        $this->assertTrue($obj->themes()->contains(new ItemCollection(1, "Отсутствует")));
        $this->assertTrue($obj->mintmarks()->contains(new ItemCollection(2, "Санкт-Петербург")));
        $this->assertTrue($obj->mintmarks()->contains(new ItemCollection(1, "Москва")));
        $this->assertTrue($obj->qualities()->contains(new ItemCollection(1, "Отличное")));
        $this->assertTrue($obj->storages()->contains(new ItemCollection(1, "Папка №10")));
    }
}
