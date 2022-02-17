<?php

namespace Database\Seeders\Deploy;

use  App\Models\Eloquent\ThemeLanguage;
use Illuminate\Database\Seeder;

class ThemeLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Отсутствует");
        $this->create(2, 2, 2, "География");
    }

    private function create(int $id, int $themeId, int $languageId, string $name): void
    {
        $object = new ThemeLanguage();
        $object->id = $id;
        $object->theme_id = $themeId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
