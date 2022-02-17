<?php

namespace Database\Seeders\Deploy;

use  App\Models\Eloquent\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Russia");
        $this->create(2, "USSR");
        $this->create(3, "Kazakhstan");
        $this->create(4, "Ukraine");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Country();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
