<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\SeoLanguage;
use Illuminate\Database\Seeder;

class SeoLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 1, "Russian Ruble", "The Russian Ruble is issued by the Bank of Russia", "Currency of Russia");
        $this->create(2, 1, 2, "Рубль России", "Рубль России выпускается Банком России", "Валюта России");
        $this->create(3, 2, 1, "Kopeck of the USSR", "Kopeck was issued in the USSR", "Currency of the USSR");
        $this->create(4, 2, 2, "Копейка СССР", "Копейка выпускалась в СССР", "Валюта СССР");
    }

    private function create(
        int $id,
        int $seoId,
        int $languageId,
        string $title,
        string $description,
        string $keywords
    ): void {
        $object = new SeoLanguage();
        $object->id = $id;
        $object->seo_id = $seoId;
        $object->language_id = $languageId;
        $object->title = $title;
        $object->description = $description;
        $object->keywords = $keywords;
        $object->save();
    }
}
