<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1);
        $this->create(2, 5);
    }

    private function create(int $id, int $coinId): void
    {
        $object = new Seo();
        $object->id = $id;
        $object->coin_id = $coinId;
        $object->save();
    }
}
