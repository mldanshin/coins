<?php

namespace Database\Seeders\Deploy;

use App\Models\Eloquent\Ordering;
use Illuminate\Database\Seeder;

class OrderingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "year");
        $this->create(2, "currency and nominal");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Ordering();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
