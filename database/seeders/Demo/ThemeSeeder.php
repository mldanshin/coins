<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Missing", 1);
        $this->create(2, "Geography", 1);
    }

    private function create(int $id, string $englishName, int $themeId): void
    {
        $object = new Theme();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->theme_id = $themeId;
        $object->save();
    }
}
