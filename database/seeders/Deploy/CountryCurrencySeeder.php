<?php

namespace Database\Seeders\Deploy;

use  App\Models\Eloquent\CountryCurrency;
use Illuminate\Database\Seeder;

class CountryCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 1);
        $this->create(2, 1, 2);
        $this->create(3, 2, 1);
        $this->create(4, 2, 2);
        $this->create(5, 3, 3);
        $this->create(6, 4, 4);
    }

    private function create(int $id, int $countryId, int $currencyId): void
    {
        $object = new CountryCurrency();
        $object->id = $id;
        $object->country_id = $countryId;
        $object->currency_id = $currencyId;
        $object->save();
    }
}
