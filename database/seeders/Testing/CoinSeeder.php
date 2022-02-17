<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\Coin;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 10, 2, 3, 1, 1, 1, "2013", 2, 1);
        $this->create(2, 2, 4, 1, 4, 2, 1, 2, "1988", 1, 2);
        $this->create(3, 3, 2, 2, 1, 3, 1, 2, "1998", 1, 2);
        $this->create(4, 3, 5, 2, 5, 3, 2, 2, "2010", 1, 3);
        $this->create(5, 4, 3, 1, 5, 4, 3, 2, "2005", 2, 4);
        $this->create(6, 2, 2, 3, 3, 2, 1, 2, "1979", 1, 2);
        $this->create(7, 1, 4, 1, 4, 2, 2, 2, "2001", 2, 2);
        $this->create(8, 1, 4, 1, 4, 1, 2, 1, "2011", 2, 3);
        $this->create(9, 2, 8, 1, 4, 1, 2, 1, "1987", 1, 1);
        $this->create(10, 1, 7, 1, 4, 2, 1, 2, "1999", 1, 1);
        $this->create(11, 2, 4, 1, 4, 1, 1, 1, "1981", 1, 1);
    }

    private function create(
        int $id,
        int $countryId,
        int $nominalId,
        int $coinageId,
        int $materialId,
        int $currencyId,
        int $shapeId,
        int $themeId,
        string $year,
        int $qualityId,
        int $storageId,
    ): void {
        $object = new Coin();
        $object->id = $id;
        $object->country_id = $countryId;
        $object->nominal_id = $nominalId;
        $object->coinage_id = $coinageId;
        $object->material_id = $materialId;
        $object->currency_id = $currencyId;
        $object->shape_id = $shapeId;
        $object->theme_id = $themeId;
        $object->year = $year;
        $object->quality_id = $qualityId;
        $object->storage_id = $storageId;
        $object->save();
    }
}
