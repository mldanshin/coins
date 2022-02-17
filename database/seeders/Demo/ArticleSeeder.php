<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1);
        $this->create(2, 6);
    }

    private function create(int $id, int $coinId): void
    {
        $object = new Article();
        $object->id = $id;
        $object->coin_id = $coinId;
        $object->save();
    }
}
