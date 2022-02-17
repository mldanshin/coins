<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\CoinageLanguage;
use Illuminate\Database\Seeder;

class CoinageLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Регулярный выпуск");
        $this->create(2, 2, 2, "Юбилейные монеты");
        $this->create(3, 3, 2, "Коллекционные монеты");
        $this->create(4, 4, 2, "Пробники(токены)");
    }

    private function create(int $id, int $coinageId, int $languageId, string $name): void
    {
        $object = new CoinageLanguage();
        $object->id = $id;
        $object->coinage_id = $coinageId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
