<?php

namespace Database\Seeders\Deploy;

use  App\Models\Eloquent\Coinage;
use Illuminate\Database\Seeder;

class CoinageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Regular");
        $this->create(2, "Jubilee");
        $this->create(3, "Collectible");
        $this->create(4, "Token");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Coinage();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
