<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\StorageLanguage;
use Illuminate\Database\Seeder;

class StorageLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "Папка №10");
        $this->create(2, 2, 2, "Шкаф №50");
        $this->create(3, 3, 2, "Сундук №55");
        $this->create(4, 4, 2,"Папка №550");
        $this->create(5, 5, 2, "Папка №777");
        $this->create(6, 6, 2, "Банк 666");
        $this->create(7, 7, 2, "Сундук №12");
    }

    private function create(int $id, int $storageId, int $languageId, string $name): void
    {
        $object = new StorageLanguage();
        $object->id = $id;
        $object->storage_id = $storageId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
