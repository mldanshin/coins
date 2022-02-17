<?php

namespace Database\Seeders\Deploy;

use App\Models\Eloquent\Storage;
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
        $this->create(1, "No data available");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Storage();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
