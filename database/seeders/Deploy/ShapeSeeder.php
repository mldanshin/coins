<?php

namespace Database\Seeders\Deploy;

use  App\Models\Eloquent\Shape;
use Illuminate\Database\Seeder;

class ShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Quadrilateral");
        $this->create(2, "Circle");
        $this->create(3, "Non-standard");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Shape();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
