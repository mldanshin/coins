<?php

namespace Database\Seeders\Deploy;

use  App\Models\Eloquent\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "en", "English", "English");
        $this->create(2, "ru", "Русский", "Russian");
    }

    private function create(int $id, string $twoLetter, string $nativeName, string $englishName): void
    {
        $object = new Language();
        $object->id = $id;
        $object->two_letter = $twoLetter;
        $object->native_name = $nativeName;
        $object->english_name = $englishName;
        $object->save();
    }
}
