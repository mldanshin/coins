<?php

namespace Database\Seeders\Deploy;

use  App\Models\Eloquent\Nominal;
use Illuminate\Database\Seeder;

class NominalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 0.25);
        $this->create(2, 0.5);
        $this->create(3, 1);
        $this->create(4, 1.5);
        $this->create(5, 2);
        $this->create(6, 3);
        $this->create(7, 4);
        $this->create(8, 5);
        $this->create(9, 6);
        $this->create(10, 7.5);
        $this->create(11, 10);
        $this->create(12, 12);
        $this->create(13, 15);
        $this->create(14, 20);
        $this->create(15, 25);
        $this->create(16, 50);
        $this->create(17, 100);
        $this->create(18, 150);
        $this->create(19, 200);
        $this->create(20, 500);
        $this->create(21, 10000);
        $this->create(22, 25000);
        $this->create(23, 50000);
    }

    private function create(int $id, float $value): void
    {
        $object = new Nominal();
        $object->id = $id;
        $object->value = $value;
        $object->save();
    }
}
