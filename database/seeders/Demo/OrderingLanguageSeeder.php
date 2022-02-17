<?php

namespace Database\Seeders\Demo;

use App\Models\Eloquent\OrderingLanguage;
use Illuminate\Database\Seeder;

class OrderingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 2, "году");
        $this->create(2, 2, 2, "валюте и номиналу");
    }

    private function create(int $id, int $orderingId, int $languageId, string $name): void
    {
        $object = new OrderingLanguage();
        $object->id = $id;
        $object->ordering_id = $orderingId;
        $object->language_id = $languageId;
        $object->name = $name;
        $object->save();
    }
}
