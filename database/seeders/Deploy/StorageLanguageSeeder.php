<?php

namespace Database\Seeders\Deploy;

use App\Models\Eloquent\StorageLanguage;
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
        $this->create(1, 1, 2, "Нет данных");
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
