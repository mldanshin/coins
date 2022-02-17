<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\MintmarkLanguage;
use Illuminate\Database\Seeder;

class MintmarkLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Москва");
        $this->create(2, 2, 2, "Санкт-Петербург");
    }

    private function create(int $id, int $mintmarkId, int $languageId, string $description): void
    {
        $object = new MintmarkLanguage();
        $object->id = $id;
        $object->mintmark_id = $mintmarkId;
        $object->language_id = $languageId;
        $object->description = $description;
        $object->save();
    }
}
