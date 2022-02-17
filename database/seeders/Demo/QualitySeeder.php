<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\Quality;
use Illuminate\Database\Seeder;

class QualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Excellent");
        $this->create(2, "Satisfactory");
        $this->create(3, "Bad");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Quality();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
