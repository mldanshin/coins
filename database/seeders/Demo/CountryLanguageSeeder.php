<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\CountryLanguage;
use Illuminate\Database\Seeder;

class CountryLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Россия");
        $this->create(2, 2, 2, "СССР");
        $this->create(3, 3, 2, "Казахстан");
        $this->create(4, 4, 2, "Украина");
    }

    private function create(int $id, int $countryId, int $languageId, string $name): void
    {
        $object = new CountryLanguage();
        $object->id = $id;
        $object->country_id = $countryId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
