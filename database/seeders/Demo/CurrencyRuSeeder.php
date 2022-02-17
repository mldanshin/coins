<?php

namespace Database\Seeders\Demo;

use  App\Models\Eloquent\CurrencyRu;
use Illuminate\Database\Seeder;

class CurrencyRuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, "Рубль", "Рубля",  "Рубля", "Рублей");
        $this->create(2, 2, "Копейка", "Копейки", "Копейки", "Копеек");
        $this->create(3, 3, "Тенге", "Тенге", "Тенге", "Тенге");
        $this->create(4, 4, "Гривна", "Гривны", "Гривны", "Гривен");
    }

    private function create(
        int $id,
        int $currencyId,
        string $singularNominative,
        string $singularGenitive,
        string $pluralNominative,
        string $pluralGenitive
    ): void {
        $object = new CurrencyRu();
        $object->id = $id;
        $object->currency_id = $currencyId;
        $object->singular_nominative = $singularNominative;
        $object->singular_genitive = $singularGenitive;
        $object->plural_nominative = $pluralNominative;
        $object->plural_genitive = $pluralGenitive;
        $object->save();
    }
}
