<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\Mintmark;
use Illuminate\Database\Seeder;

class MintmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "M", "Moscow");
        $this->create(2, "SB", "Saint-Petersburg");
    }

    private function create(int $id, string $value, string $englishDecryption): void
    {
        $object = new Mintmark();
        $object->id = $id;
        $object->value = $value;
        $object->english_description = $englishDecryption;
        $object->save();
    }
}
