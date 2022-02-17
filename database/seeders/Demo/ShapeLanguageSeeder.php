<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\ShapeLanguage;
use Illuminate\Database\Seeder;

class ShapeLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Четырёхугольник");
        $this->create(2, 2, 2, "Круг");
        $this->create(3, 3, 2, "Нестандарт");
    }

    private function create(int $id, int $shapeId, int $languageId, string $name): void
    {
        $object = new ShapeLanguage();
        $object->id = $id;
        $object->shape_id = $shapeId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
