<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "Ruble");
        $this->create(2, "Kopeck");
        $this->create(3, "Tenge");
        $this->create(4, "Hryvnia");
    }

    private function create(int $id, string $englishName): void
    {
        $object = new Currency();
        $object->id = $id;
        $object->english_name = $englishName;
        $object->save();
    }
}
