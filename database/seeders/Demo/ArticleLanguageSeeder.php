<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\ArticleLanguage;
use Illuminate\Database\Seeder;

class ArticleLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 1, "Article about the Russian Ruble", "In this article we will talk about the currency of Russia...");
        $this->create(2, 1, 2, "Статья про рубль России", "В этой статья поговорим о валюте России...");
        $this->create(3, 2, 1, "A story about a penny from the USSR", "In this article we will talk about the currency of Russia...");
        $this->create(4, 2, 2, "История про копейку времён СССР", "В этой статье я расскажу историю о копейке времен СССР...");
    }

    private function create(
        int $id,
        int $articleId,
        int $languageId,
        string $title,
        string $content,
    ): void {
        $object = new ArticleLanguage();
        $object->id = $id;
        $object->article_id = $articleId;
        $object->language_id = $languageId;
        $object->title = $title;
        $object->content = $content;
        $object->save();
    }
}
