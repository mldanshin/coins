<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\Storage;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Folder №10");
        $this->create(2, "Wardrobe №50");
        $this->create(3, "Chest №55");
        $this->create(4, "Folder №550");
        $this->create(5, "Folder №777");
        $this->create(6, "Bank 666");
        $this->create(7, "Chest №12");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Storage();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
