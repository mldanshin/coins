<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\MaterialLanguage;
use Illuminate\Database\Seeder;

class MaterialLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Алюминиевая бронза");
        $this->create(2, 2, 2, "Би-металл");
        $this->create(3, 3, 2, "Бронза");
        $this->create(4, 4, 2, "Золото");
        $this->create(5, 5, 2, "Латунь");
        $this->create(6, 6, 2, "Медно-никелевый сплав");
        $this->create(7, 7, 2, "Медь");
        $this->create(8, 8, 2, "Медь с медно-никелевым покрытием");
        $this->create(9, 9, 2, "Медь-Цинк-Никель");
        $this->create(10, 10, 2, "Палладий");
        $this->create(11, 11, 2, "Платина");
        $this->create(12, 12, 2, "Серебро");
        $this->create(13, 13, 2, "Сплав алюминия с титаном");
        $this->create(14, 14, 2, "Сталь с латунным покрытием");
        $this->create(15, 15, 2, "Сталь с медно-никелевым покрытием");
        $this->create(16, 16, 2, "Сталь с медным покрытием");
        $this->create(17, 17, 2, "Сталь с никелевым покрытием");
    }

    private function create(int $id, int $materialId, int $languageId, string $name): void
    {
        $object = new MaterialLanguage();
        $object->id = $id;
        $object->material_id = $materialId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
