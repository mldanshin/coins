<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Aluminum bronze");
        $this->create(2, "Bimetal");
        $this->create(3, "Bronze");
        $this->create(4, "Gold");
        $this->create(5, "Brass");
        $this->create(6, "Copper-nickel alloy");
        $this->create(7, "Copper");
        $this->create(8, "Copper with copper-nickel coating");
        $this->create(9, "Copper-Zinc-Nickel");
        $this->create(10, "Palladium");
        $this->create(11, "Platinum");
        $this->create(12, "Silver");
        $this->create(13, "Aluminum alloy with titanium");
        $this->create(14, "Steel with brass coating");
        $this->create(15, "Steel with copper-nickel coating");
        $this->create(16, "Copper-coated steel");
        $this->create(17, "Nickel-plated steel");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Material();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
