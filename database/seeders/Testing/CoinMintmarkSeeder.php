<?php

namespace Database\Seeders\Testing;

use  App\Models\Eloquent\CoinMintmark;
use Illuminate\Database\Seeder;

class CoinMintmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 1, 1);
        $this->create(2, 7, 2);
    }

    private function create(int $id, int $coinId, int $mintmarkId): void
    {
        $object = new CoinMintmark();
        $object->id = $id;
        $object->coin_id = $coinId;
        $object->mintmark_id = $mintmarkId;
        $object->save();
    }
}
