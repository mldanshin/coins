<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\CurrencyEn;
use Illuminate\Database\Seeder;

class CurrencyEnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, "Ruble", "Rubles");
        $this->create(2, 2, "Kopeck", "Kopecks");
        $this->create(3, 3, "Tenge", "Tenge");
        $this->create(4, 4, "Hryvnia", "Hryvnia");
    }

    private function create(
        int $id,
        int $currencyId,
        string $singular,
        string $plural,
    ): void {
        $object = new CurrencyEn();
        $object->id = $id;
        $object->currency_id = $currencyId;
        $object->singular = $singular;
        $object->plural = $plural;
        $object->save();
    }
}
