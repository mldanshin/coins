<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\QualityLanguage;
use Illuminate\Database\Seeder;

class QualityLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Отличное");
        $this->create(2, 2, 2, "Удовлетворительное");
        $this->create(3, 3, 2, "Плохое");
    }

    private function create(int $id, int $qualityId, int $languageId, string $name): void
    {
        $object = new QualityLanguage();
        $object->id = $id;
        $object->quality_id = $qualityId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
